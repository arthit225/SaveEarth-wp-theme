<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Iris\Data\Feed;
use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaType;
use RebelCode\Spotlight\Instagram\Engine\Data\Source\UserSource;
use RebelCode\Spotlight\Instagram\Feeds\FeedManager;
use RebelCode\Spotlight\Instagram\IgApi\IgAccount;
use RebelCode\Spotlight\Instagram\PostTypes\AccountPostType;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use RebelCode\Spotlight\Instagram\Server;
use RebelCode\Spotlight\Instagram\Wp\PostType;
use RuntimeException;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

abstract class AbstractAnalyticsEndPoint extends AbstractEndpointHandler
{
    /** @var Server */
    protected $server;

    /** @var PostType */
    protected $accounts;

    /** @var FeedManager */
    protected $feeds;

    abstract protected function getAnalytics(WP_REST_Request $request): array;

    protected function handle(WP_REST_Request $request)
    {
        // Set the PHP timezone to be WordPress' settings timezone
        date_default_timezone_set(wp_timezone()->getName());

        try {
            return new WP_REST_Response($this->getAnalytics($request));
        } catch (RuntimeException $exception) {
            return new WP_Error('sli_request_error', $exception->getMessage(), ['status' => $exception->getCode()]);
        }
    }

    protected function getFeed(WP_REST_Request $request): Feed
    {
        $feedId = $request->get_param('feed');
        if (empty($feedId)) {
            throw new RuntimeException('Missing feed ID in request', 400);
        }

        $feed = $this->feeds->get($feedId);
        if ($feed === null) {
            throw new RuntimeException('Invalid feed ID - feed does not exist', 400);
        }

        return $feed;
    }

    protected function getAccount(WP_REST_Request $request): IgAccount
    {
        $username = $request->get_param('username');
        if (empty($username)) {
            throw new RuntimeException('Missing account username in request', 400);
        }

        $account = AccountPostType::getByUsername($this->accounts, $username);
        if ($account === null) {
            throw new RuntimeException('Invalid username - account does not exist', 400);
        }

        return $account;
    }

    protected function getDateRange(WP_REST_Request $request): array
    {
        $startStr = $request->get_param('start');
        $endStr = $request->get_param('end');

        $start = $startStr ? strtotime($startStr) : null;
        $end = $endStr ? strtotime($endStr) : null;

        return [$start, $end];
    }

    protected function getSorting(WP_REST_Request $request): array
    {
        $sortBy = $request->get_param('sortBy') ?? 'post';
        $sortDir = $request->get_param('sortDir') ?? 'desc';

        return [$sortBy, $sortDir];
    }

    protected function getPagination(WP_REST_Request $request): array
    {
        $from = $request->get_param('from') ?? 0;
        $num = $request->get_param('num');

        return [$from, $num];
    }

    protected function queryAccountPosts(
        IgAccount $account,
        int $from,
        ?int $num,
        string $sortBy,
        string $sortDir
    ): array {
        $source = UserSource::create($account->user->username, $account->user->type);

        return ($sortBy === 'post')
            ? $this->server->getSourceMedia($source, $from, $num, $sortDir === 'asc')
            : $this->server->getSourceMedia($source, 0, PHP_INT_MAX);
    }

    protected function queryFeedPosts(Feed $feed, int $from, ?int $num, string $sortBy, string $sortDir): array
    {
        if (empty($feed->sources)) {
            return [
                'media' => [],
                'total' => 0,
            ];
        }

        if ($sortBy === 'post') {
            $feed->data['postOrder'] = 'date_' . $sortDir;
            $result = $this->server->getFeedMedia($feed->data, $from, $num);
        } else {
            $feed->data['numPosts'] = null;
            $result = $this->server->getFeedMedia($feed->data);
        }

        return $result;
    }

    protected function sortResults(array $results, string $sortBy, string $sortDir, array $sortingFns): array
    {
        $sortFn = $sortingFns[$sortBy] ?? null;

        if ($sortFn) {
            if ($sortDir === "desc") {
                $ogSortFn = $sortFn;
                $sortFn = function ($a, $b) use ($ogSortFn, $sortDir) {
                    return $ogSortFn($a, $b) * -1;
                };
            }

            usort($results, $sortFn);
        }

        return $results;
    }

    protected function comparePostTypes(string $type1, string $type2): int
    {
        $value1 = $type1 === MediaType::IMAGE ? 1 : ($type1 === MediaType::VIDEO ? 2 : 3);
        $value2 = $type2 === MediaType::IMAGE ? 1 : ($type2 === MediaType::VIDEO ? 2 : 3);

        return $value1 <=> $value2;
    }
}
