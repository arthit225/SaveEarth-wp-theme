<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher;

use Psr\Http\Client\ClientInterface;
use RebelCode\Iris\Data\Source;
use RebelCode\Iris\Exception\FetchException;
use RebelCode\Iris\Fetcher\Catalog;
use RebelCode\Iris\Fetcher\FetchResult;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\TaggedUserSource;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\UserSource;
use RebelCode\Spotlight\Instagram\Engine\Fetcher\IgPostsCatalog;
use RebelCode\Spotlight\Instagram\IgApi\IgApiUtils;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\Wp\PostType;

/**
 * Provides Instagram media from a user's story.
 */
class StoryPostsCatalog implements Catalog
{
    /** @var ClientInterface */
    protected $client;

    /** @var PostType */
    protected $accounts;

    /** Constructor. */
    public function __construct(ClientInterface $client, PostType $accounts)
    {
        $this->client = $client;
        $this->accounts = $accounts;
    }

    /** @inheritDoc */
    public function query(Source $source, ?string $cursor = null, ?int $count = null): FetchResult
    {
        $username = $source->id;

        if (empty($username) || ($source->type !== UserSource::TYPE_BUSINESS && $source->type !== TaggedUserSource::TYPE)) {
            return new FetchResult([], $source, null, null, null, [
                'Invalid source type',
            ]);
        }

        $account = AccountPostType::getByUsername($this->accounts, $username);

        if ($account === null) {
            throw new FetchException("Account \"@{$username}\" does not exist", null, $source, $cursor);
        }

        $userId = $account->user->id;
        $baseUrl = IgPostsCatalog::GRAPH_API_URL;
        $url = "{$baseUrl}/{$userId}/stories";

        $args = [
            'access_token' => $account->accessToken->code,
            'fields' => implode(',', IgApiUtils::getStoryMediaFields()),
        ];

        return IgPostsCatalog::requestItems($this->client, $source, $cursor, $count, $url, $args);
    }
}
