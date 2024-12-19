<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Feeds\FeedManager;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RebelCode\Spotlight\Instagram\Performance\Analytics\Data\PromoClickSource;
use RebelCode\Spotlight\Instagram\Server;
use WP_REST_Request;

/** The endpoint that handles requests for retrieving promotion analytics. */
class GetPromotionAnalyticsEndPoint extends AbstractAnalyticsEndPoint
{
    /** @var AnalyticsProcessor */
    protected $analytics;

    /** @var Server */
    protected $server;

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
        $instance = $request->get_param('instance');
        [$start, $end] = $this->getDateRange($request);
        [$sortBy, $sortDir] = $this->getSorting($request);
        [$from, $num] = $this->getPagination($request);

        $result = $this->queryFeedPosts($feed, $from, $num, $sortBy, $sortDir);

        foreach ($result['media'] as $i => $media) {
            $postId = $media['id'];

            $directClicks = $this->analytics->getSum(
                $this->analytics->promoClicks($postId, PromoClickSource::DIRECT, $instance),
                $start,
                $end
            );

            $popupClicks = $this->analytics->getSum(
                $this->analytics->promoClicks($postId, PromoClickSource::POPUP, $instance),
                $start,
                $end
            );

            $result['media'][$i] = [
                'info' => $media,
                'engagement' => [
                    'clicks' => [
                        'direct' => $directClicks,
                        'popup' => $popupClicks,
                    ],
                ],
            ];
        }

        $result['media'] = $this->sortResults($result['media'], $sortBy, $sortDir, [
            'type' => function ($a, $b) {
                return $this->comparePostTypes($a['info']['type'], $b['info']['type']);
            },
            'direct' => function ($a, $b) {
                return $a['engagement']['clicks']['direct'] <=> $b['engagement']['clicks']['direct'];
            },
            'popup' => function ($a, $b) {
                return $a['engagement']['clicks']['popup'] <=> $b['engagement']['clicks']['popup'];
            },
        ]);

        return $result;
    }
}
