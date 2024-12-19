<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RebelCode\Spotlight\Instagram\Server;
use RebelCode\Spotlight\Instagram\Wp\PostType;
use WP_REST_Request;

/** The endpoint that handles requests for retrieving post insights analytics. */
class GetInsightsAnalyticsEndPoint extends AbstractAnalyticsEndPoint
{
    /** @var AnalyticsProcessor */
    protected $analytics;

    /** Constructor. */
    public function __construct(AnalyticsProcessor $analytics, Server $server, PostType $accounts)
    {
        $this->analytics = $analytics;
        $this->server = $server;
        $this->accounts = $accounts;
    }

    /** @inerhitDoc */
    protected function getAnalytics(WP_REST_Request $request): array
    {
        $account = $this->getAccount($request);
        [$start, $end] = $this->getDateRange($request);
        [$from, $num] = $this->getPagination($request);
        [$sortBy, $sortDir] = $this->getSorting($request);

        $result = $this->queryAccountPosts($account, $from, $num, $sortBy, $sortDir);

        foreach ($result['media'] as $i => $media) {
            $postId = $media['id'];

            $result['media'][$i] = [
                'info' => $media,
                'insights' => [
                    'likes' => $this->analytics->getGrowth($this->analytics->postLikes($postId), $start, $end),
                    'comments' => $this->analytics->getGrowth($this->analytics->postComments($postId), $start, $end),
                ],
            ];
        }

        $result['media'] = $this->sortResults($result['media'], $sortBy, $sortDir, [
            'type' => function ($a, $b) {
                return $this->comparePostTypes($a['info']['type'], $b['info']['type']);
            },
            'likes' => function ($a, $b) {
                return $a['insights']['likes']->thisPeriod <=> $b['insights']['likes']->thisPeriod;
            },
            'comments' => function ($a, $b) {
                return $a['insights']['comments']->thisPeriod <=> $b['insights']['comments']->thisPeriod;
            },
        ]);

        return $result;
    }
}
