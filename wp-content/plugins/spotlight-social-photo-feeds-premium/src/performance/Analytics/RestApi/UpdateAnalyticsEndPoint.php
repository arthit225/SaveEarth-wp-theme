<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsCollector;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use WP_REST_Request;
use WP_REST_Response;

class UpdateAnalyticsEndPoint extends AbstractEndpointHandler
{
    /** @var AnalyticsCollector */
    protected $collector;

    /** Constructor. */
    public function __construct(AnalyticsCollector $collector)
    {
        $this->collector = $collector;
    }

    /** @inerhitDoc */
    protected function handle(WP_REST_Request $request): WP_REST_Response
    {
        sleep(5);
        $this->collector->collect();
        sleep(5);

        return new WP_REST_Response(['success' => true]);
    }
}
