<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher;

use Exception;
use Psr\Http\Client\ClientInterface;
use RebelCode\Iris\Data\Source;
use RebelCode\Iris\Fetcher\Catalog;
use RebelCode\Iris\Fetcher\FetchResult;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\HashtagSource;
use RebelCode\Spotlight\Instagram\Engine\Fetcher\IgPostsCatalog;
use RebelCode\Spotlight\Instagram\IgApi\IgAccount;
use RebelCode\Spotlight\Instagram\IgApi\IgApiUtils;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\Wp\PostType;

/**
 * Provides Instagram media for an Instagram hashtag.
 */
class HashtagPostsCatalog implements Catalog
{
    const DEFAULT_LIMIT = 50;
    const TOP_MEDIA = 'top_media';
    const RECENT_MEDIA = 'recent_media';

    /** @var ClientInterface */
    protected $client;

    /** @var PostType */
    protected $accounts;

    /** Constructor */
    public function __construct(ClientInterface $client, PostType $accounts)
    {
        $this->client = $client;
        $this->accounts = $accounts;
    }

    public function query(Source $source, ?string $cursor = null, ?int $count = null): FetchResult
    {
        $hashtag = $source->id;
        $type = $source->type;

        // Validate source
        if (($type !== HashtagSource::TYPE_POPULAR && $type !== HashtagSource::TYPE_RECENT) || empty($hashtag)) {
            return new FetchResult([], $source, 0, null, null, [
                'Invalid hashtag source.',
            ]);
        }

        // Get business account
        $account = AccountPostType::findBusinessAccount($this->accounts);
        if ($account === null) {
            return new FetchResult([], $source, 0, null, null, [
                'A business account is required for fetching hashtag posts, none found.',
            ]);
        }

        // Get hashtag ID from Instagram
        try {
            $hashtagId = $this->getHashtagId($hashtag, $account);
        } catch (Exception $ex) {
            return new FetchResult([], $source, 0, null, null, [
                "The #{$hashtag} hashtag does not exist on Instagram.",
            ]);
        }

        $baseUrl = IgPostsCatalog::GRAPH_API_URL;
        $hashtagType = ($type === HashtagSource::TYPE_RECENT) ? static::RECENT_MEDIA : static::TOP_MEDIA;
        $url = "{$baseUrl}/{$hashtagId}/{$hashtagType}";
        $limit = $count ?? static::DEFAULT_LIMIT;

        $args = [
            'fields' => implode(',', IgApiUtils::getHashtagMediaFields()),
            'user_id' => $account->user->id,
            'access_token' => $account->accessToken->code,
        ];

        return IgPostsCatalog::requestItems($this->client, $source, $cursor, $limit, $url, $args);
    }

    protected function getHashtagId(string $hashtag, IgAccount $account): ?string
    {
        $baseUrl = IgPostsCatalog::GRAPH_API_URL;
        $request = IgApiUtils::createRequest('GET', "{$baseUrl}/ig_hashtag_search", [
            'q' => $hashtag,
            'user_id' => $account->user->id,
            'access_token' => $account->accessToken->code,
            'limit' => 1,
        ]);

        $response = IgApiUtils::sendRequest($this->client, $request);
        $body = IgApiUtils::parseResponse($response);

        return $body['data'][0]['id'] ?? null;
    }
}
