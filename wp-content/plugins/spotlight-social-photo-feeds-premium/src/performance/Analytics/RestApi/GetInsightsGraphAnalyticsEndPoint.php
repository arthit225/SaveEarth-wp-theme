<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RuntimeException;
use WP_REST_Request;

class GetInsightsGraphAnalyticsEndPoint extends AbstractAnalyticsEndPoint
{
    /** @var AnalyticsProcessor */
    protected $analytics;

    /**
     * @param AnalyticsProcessor $analytics
     */
    public function __construct(AnalyticsProcessor $analytics)
    {
        $this->analytics = $analytics;
    }

    protected function getAnalytics(WP_REST_Request $request): array
    {
        $postId = $request->get_param('post');
        if (empty($postId)) {
            throw new RuntimeException('Invalid post ID', 400);
        }

        [$start, $end] = $this->getDateRange($request);

        $likesGraph = $this->analytics->getGraph(
            $this->analytics->postLikes($postId),
            $start,
            $end
        );

        $commentsGraph = $this->analytics->getGraph(
            $this->analytics->postComments($postId),
            $start,
            $end
        );

        return [
            'likes' => [
                'data' => $likesGraph->data,
                'step' => $likesGraph->step,
            ],
            'comments' => [
                'data' => $commentsGraph->data,
                'step' => $commentsGraph->step,
            ],
        ];
    }
}
