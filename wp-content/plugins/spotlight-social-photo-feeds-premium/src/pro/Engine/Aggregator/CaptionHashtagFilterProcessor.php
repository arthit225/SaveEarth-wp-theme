<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Aggregator;

use RebelCode\Iris\Aggregator\ItemProcessor;
use RebelCode\Iris\Data\Feed;
use RebelCode\Iris\Data\Item;
use RebelCode\Iris\Store\Query;
use RebelCode\Spotlight\Instagram\Config\ConfigSet;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaItem;

/**
 * An item processor that filters out media according to the caption and hashtag feed filters and global filters.
 */
class CaptionHashtagFilterProcessor implements ItemProcessor
{
    /** The regex pattern to use for caption filtering. */
    const CAPTION_REGEX = '(^|\b)((?<!#)%s)\b';
    /** The regex pattern to use for hashtag filtering. */
    const HASHTAG_REGEX = '(^|\s)#%s\b';
    /** The regex delimiter used by all regex patterns in this class. */
    const REGEX_DELIMITER = '/';

    /** @var ConfigSet */
    protected $config;

    /**
     * The flag that determines if multi-byte internal encoding switching will take place.
     *
     * @var bool
     */
    protected $canSwitchEncoding;

    /**
     * Stores the multi-byte internal encoding, to switch back to it after filtering is completed.
     *
     * @var string
     */
    protected $prevEncoding;

    /** Constructor. */
    public function __construct(ConfigSet $config)
    {
        $this->config = $config;
        $this->canSwitchEncoding = function_exists('mb_internal_encoding');
        $this->prevEncoding = null;
    }

    /** @inheritDoc */
    public function process(array &$items, Feed $feed, Query $query): void
    {
        $this->switchEncodingTo('UTF-8');

        $hashtagFilters = $this->getFilters('hashtag', $feed);
        $captionFilters = $this->getFilters('caption', $feed);

        $filters = [
            [
                'regex' => $this->compileRegex(static::HASHTAG_REGEX, $hashtagFilters['blacklist']),
                'negated' => true,
            ],
            [
                'regex' => $this->compileRegex(static::HASHTAG_REGEX, $hashtagFilters['whitelist']),
                'negated' => false,
            ],
            [
                'regex' => $this->compileRegex(static::CAPTION_REGEX, $captionFilters['blacklist']),
                'negated' => true,
            ],
            [
                'regex' => $this->compileRegex(static::CAPTION_REGEX, $captionFilters['whitelist']),
                'negated' => false,
            ],
        ];

        // Remove filters that have a null regex pattern, to reduce the number of iterations performed in each
        // `array_filter()` function call, iterating only over valid filters. This has a guaranteed time complexity of
        // O(4), while checking if the filter regex is null inside the `array_filter()` function will be O(n) where
        // `n` is the number of media posts that are being processed. The latter is typically bigger than 4.
        $filters = array_filter($filters, function ($filter) {
            return $filter['regex'] !== null;
        });

        $items = array_filter($items, function ($item) use ($filters) {
            if (!($item instanceof Item)) {
                return false;
            }

            $caption = $item->data[MediaItem::CAPTION] ?? '';

            foreach ($filters as $filter) {
                $matched = preg_match($filter['regex'], $caption) === 1;
                $negated = $filter['negated'];

                // Explanation of the equivalence check:
                // * If the filter is negated (true) and the regex matched (true), filter out the media
                // * If the filter is not negated (false) and the regex did not match (false), filter out the media
                // This is equivalent to an XOR check, but much more readable given the scenario.
                if ($matched === $negated) {
                    return false;
                }
            }

            return true;
        });

        $this->restoreEncoding();
    }

    /**
     * Compiles the regex for a given set of filters.
     *
     * @param string $format  The regex format string, expected to have a "%s" or equivalent token.
     * @param array  $filters A list of filters.
     *
     * @return string|null The regex pattern, compiled by interpolating a capture group that includes all the filters
     *                     in the given list, into the given regex pattern. If the list is empty, null is returned.
     */
    protected function compileRegex(string $format, array $filters): ?string
    {
        if (empty($filters)) {
            return null;
        }

        // Convert each filter into a regex fragment
        $regexFragments = array_map([$this, 'filterToRegex'], $filters);
        // Implode the fragments using a pipe, for use in a capture group
        $regexCapture = '(' . implode('|', $regexFragments) . ')';
        // Interpolate the capture group into the regex format
        $regexFull = sprintf($format, $regexCapture);

        // Finally, add the delimiters and modifiers
        return static::REGEX_DELIMITER . $regexFull . static::REGEX_DELIMITER . 'ui';
    }

    /**
     * Converts a single filter into a regex string.
     *
     * This mainly does 2 things:
     * 1. Quote special regex characters in the string
     * 2. Replace whitespace characters with a regex token that matches any whitespace character once or more times
     *
     * @param string $filter The filter string.
     *
     * @return string The regex string.
     */
    protected function filterToRegex(string $filter): string
    {
        // Quote the filter to prevent regex injection
        $quoted = preg_quote($filter, static::REGEX_DELIMITER);

        // Replace all whitespace characters with a whitespace regex token.
        // In the event of failure, fallback to the quoted version
        $result = preg_replace('/\s+/', '\s+', $quoted);
        $result = is_string($result) ? $result : $quoted;

        return $result;
    }

    /**
     * Retrieves a specific list of filters for a given feed.
     *
     * This method does the following:
     * * Obtain the list of filters from the feed's options
     * * If the feed's filters are set to include the global filters, they are included
     * * Equal opposing[+] filters between the feed and global lists are processed using the feed's priority option
     *
     * [+] Opposing here means that the filter is present as both a whitelist entry and a blacklist entry.
     *
     * @param string $type The filter type, either "hashtag" or "caption". This string is used to determine the key
     *                     of the options to read from. Example: "hashtagWhitelist".
     * @param Feed $feed The feed instance.
     *
     * @return array An associative array containing two keys: "whitelist" and "blacklist", each of which map to
     *               sub-arrays that contain the filters as values, numerically indexed.
     */
    protected function getFilters(string $type, Feed $feed): array
    {
        $whitelistKey = $type . 'Whitelist';
        $blacklistKey = $type . 'Blacklist';

        // Get the feed's whitelist and blacklist
        $feedWl = $feed->get($whitelistKey, []);
        $feedBl = $feed->get($blacklistKey, []);

        // Get the options that decide whether to use the global whitelist and blacklist
        $useGlobalWl = filter_var($feed->get($whitelistKey . 'Settings', false), FILTER_VALIDATE_BOOLEAN);
        $useGlobalBl = filter_var($feed->get($blacklistKey . 'Settings', false), FILTER_VALIDATE_BOOLEAN);

        // If not using global filters, simply return the feed's filters
        if (!$useGlobalWl && !$useGlobalBl) {
            return [
                'whitelist' => $feedWl,
                'blacklist' => $feedBl,
            ];
        }

        // The flip allows for faster lookup and manipulation
        $feedWl = array_flip($feedWl);
        $feedBl = array_flip($feedBl);

        // Get the option that decides whether feed filters take priority over global ones
        $prioritizeFeed = $feed->get($type . 'Priority', true);
        // The global filters. We will only retrieve these if needed
        $globalWl = [];
        $globalBl = [];

        // If using the global whitelist, account for prioritization
        if ($useGlobalWl) {
            $globalWl = array_flip($this->config->get($whitelistKey)->getValue());

            // If prioritizing the feed's filters
            if ($prioritizeFeed) {
                // Remove all blacklist entries from the global whitelist
                $globalWl = array_diff_key($globalWl, $feedBl);
            } else {
                // Otherwise, remove all global whitelist entries from the feed's blacklist
                $feedBl = array_diff_key($feedBl, $globalWl);
            }
        }

        // If using the global blacklist, account for prioritization
        if ($useGlobalBl) {
            $globalBl = array_flip($this->config->get($blacklistKey)->getValue());

            // If prioritizing the feed's filters
            if ($prioritizeFeed) {
                // Remove all whitelist entries from the global blacklist
                $globalBl = array_diff_key($globalBl, $feedWl);
            } else {
                // Otherwise, remove all global blacklist entries from the feed's whitelist
                $feedWl = array_diff_key($feedWl, $globalBl);
            }
        }

        // Merge the whitelists
        $whitelist = !empty($globalWl)
            ? array_merge($feedWl, $globalWl)
            : $feedWl;

        // Merge the blacklists
        $blacklist = !empty($globalBl)
            ? array_merge($feedBl, $globalBl)
            : $feedBl;

        // We need to flip each list back in order to return the filters as array values
        return [
            'whitelist' => array_keys($whitelist),
            'blacklist' => array_keys($blacklist),
        ];
    }

    /**
     * Switches the internal multi-byte encoding, if possible.
     *
     * @param string $encoding The encoding to switch to.
     */
    protected function switchEncodingTo(string $encoding)
    {
        if (!$this->canSwitchEncoding) {
            return;
        }

        $this->prevEncoding = mb_internal_encoding();

        mb_internal_encoding($encoding);
    }

    /**
     * Restores the original multi-byte internal encoding, if it was previously switched.
     */
    protected function restoreEncoding()
    {
        if ($this->canSwitchEncoding && !empty($this->prevEncoding)) {
            mb_internal_encoding($this->prevEncoding);
        }
    }
}
