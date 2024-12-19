<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Engine\Data\Item\MediaType;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsProcessor;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use RebelCode\Spotlight\Instagram\Wp\PostType;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

/** The endpoint that handles requests for retrieving the account analytics. */
class GetAccountAnalyticsEndPoint extends AbstractAnalyticsEndPoint
{
    /** @var AnalyticsProcessor */
    protected $processor;

    /** Constructor. */
    public function __construct(AnalyticsProcessor $processor, PostType $accounts)
    {
        $this->processor = $processor;
        $this->accounts = $accounts;
    }

    /** @inerhitDoc */
    protected function getAnalytics(WP_REST_Request $request): array
    {
        $account = $this->getAccount($request);
        [$start, $end] = $this->getDateRange($request);

        // The data points
        $followersDp = $this->processor->followers($account->user->username);
        $accountLikes = $this->processor->accountLikes($account->user->username);
        $accountComments = $this->processor->accountComments($account->user->username);
        $imageLikes = $this->processor->typeLikes(MediaType::IMAGE, $account->user->username);
        $imageComments = $this->processor->typeComments(MediaType::IMAGE, $account->user->username);
        $videoLikes = $this->processor->typeLikes(MediaType::VIDEO, $account->user->username);
        $videoComments = $this->processor->typeComments(MediaType::VIDEO, $account->user->username);
        $galleryLikes = $this->processor->typeLikes(MediaType::ALBUM, $account->user->username);
        $galleryComments = $this->processor->typeComments(MediaType::ALBUM, $account->user->username);

        return [
            'followers' => [
                'growth' => $this->processor->getGrowth($followersDp, $start, $end),
                'graph' => $this->processor->getGraph($followersDp, $start, $end),
                'total' => $this->processor->getLatest($followersDp),
            ],
            'likes' => [
                'all' => [
                    'growth' => $this->processor->getGrowth($accountLikes, $start, $end),
                    'total' => $this->processor->getSum($accountLikes),
                ],
                'images' => [
                    'growth' => $this->processor->getGrowth($imageLikes, $start, $end),
                    'total' => $this->processor->getSum($imageLikes),
                ],
                'videos' => [
                    'growth' => $this->processor->getGrowth($videoLikes, $start, $end),
                    'total' => $this->processor->getSum($videoLikes),
                ],
                'galleries' => [
                    'growth' => $this->processor->getGrowth($galleryLikes, $start, $end),
                    'total' => $this->processor->getSum($galleryLikes),
                ],
            ],
            'comments' => [
                'all' => [
                    'growth' => $this->processor->getGrowth($accountComments, $start, $end),
                    'total' => $this->processor->getSum($accountComments),
                ],
                'images' => [
                    'growth' => $this->processor->getGrowth($imageComments, $start, $end),
                    'total' => $this->processor->getSum($imageComments),
                ],
                'videos' => [
                    'growth' => $this->processor->getGrowth($videoComments, $start, $end),
                    'total' => $this->processor->getSum($videoComments),
                ],
                'galleries' => [
                    'growth' => $this->processor->getGrowth($galleryComments, $start, $end),
                    'total' => $this->processor->getSum($galleryComments),
                ],
            ],
        ];
    }
}
