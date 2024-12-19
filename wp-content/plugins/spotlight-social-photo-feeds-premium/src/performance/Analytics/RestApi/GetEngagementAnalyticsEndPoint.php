<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaType;
use RebelCode\Spotlight\Instagram\Feeds\FeedManager;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RebelCode\Spotlight\Instagram\Server;
use WP_REST_Request;

/** The endpoint that handles requests for retrieving post insights analytics. */
class GetEngagementAnalyticsEndPoint extends AbstractAnalyticsEndPoint
{
    /** @var AnalyticsProcessor */
    protected $analytics;

    /** @var Server */
    protected $server;

    /** @var FeedManager */
    protected $feeds;

    /** Constructor. */
    public function __construct(AnalyticsProcessor $analytics, Server $server, FeedManager $feeds)
    {
        $this->analytics = $analytics;
        $this->server = $server;
        $this->feeds = $feeds;
    }

    /** @inerhitDoc */
    protected function getAnalytics(WP_REST_Request $request): array
    {
        $feed = $this->getFeed($request);
        [$start, $end] = $this->getDateRange($request);
        [$from, $num] = $this->getPagination($request);
        [$sortBy, $sortDir] = $this->getSorting($request);

        $result = $this->queryFeedPosts($feed, $from, $num, $sortBy, $sortDir);

        $totalClicks = [
            'images' => 0,
            'videos' => 0,
            'galleries' => 0,
        ];

        foreach ($result['media'] as $i => $media) {
            $postId = $media['id'];
            $clicks = $this->analytics->getSum($this->analytics->postClicks($postId), $start, $end);

            $result['media'][$i] = [
                'info' => $media,
                'engagement' => [
                    'clicks' => $clicks,
                ],
            ];

            switch ($media['type']) {
                case MediaType::IMAGE:
                {
                    $totalClicks['images'] += $clicks;
                    break;
                }
                case MediaType::VIDEO:
                {
                    $totalClicks['videos'] += $clicks;
                    break;
                }
                case MediaType::ALBUM:
                {
                    $totalClicks['galleries'] += $clicks;
                    break;
                }
            }
        }

        $result['engagement'] = [
            'clicks' => $totalClicks,
        ];

        $result['media'] = $this->sortResults($result['media'], $sortBy, $sortDir, [
            'type' => function ($a, $b) {
                return $this->comparePostTypes($a['info']['type'], $b['info']['type']);
            },
            'clicks' => function ($a, $b) {
                return $a['engagement']['clicks'] <=> $b['engagement']['clicks'];
            },
        ]);

        return $result;
    }
}
