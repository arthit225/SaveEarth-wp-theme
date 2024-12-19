<?php

namespace RebelCode\Spotlight\Instagram\Pro\Engine\Fetcher;

use Psr\Http\Client\ClientInterface;
use RebelCode\Iris\Data\Source;
use RebelCode\Iris\Exception\FetchException;
use RebelCode\Iris\Fetcher\Catalog;
use RebelCode\Iris\Fetcher\FetchResult;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\TaggedUserSource;
use RebelCode\Spotlight\Instagram\Engine\Fetcher\IgPostsCatalog;
use RebelCode\Spotlight\Instagram\IgApi\IgApiUtils;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\Wp\PostType;

/**
 * Provides Instagram media where an Instagram account is tagged.
 */
class TaggedPostsCatalog implements Catalog
{
    const DEFAULT_LIMIT = 50;

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

    public function query(Source $source, ?string $cursor = null, ?int $count = null): FetchResult
    {
        if ($source->type !== TaggedUserSource::TYPE || empty($source->id)) {
            return new FetchResult([], $source, null, null, null, [
                'Invalid source type',
            ]);
        }

        $username = $source->id;
        $account = AccountPostType::getByUsername($this->accounts, $username);

        if ($account === null) {
            throw new FetchException("Account \"@{$username}\" does not exist", null, $source, $cursor);
        }

        $userId = $account->user->id;
        $accessToken = $account->accessToken;

        $baseUrl = IgPostsCatalog::GRAPH_API_URL;
        $url = "{$baseUrl}/{$userId}/tags";
        $limit = $count ?? static::DEFAULT_LIMIT;

        $args = [
            'access_token' => $accessToken->code,
            'fields' => implode(',', IgApiUtils::getBusinessMediaFields(false)),
        ];

        return IgPostsCatalog::requestItems($this->client, $source, $cursor, $limit, $url, $args);
    }
}
