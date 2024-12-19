<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsCollector;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use WP_REST_Request;
use WP_REST_Response;

class AddPostClickEndPoint extends AbstractEndpointHandler
{
    /** @var AnalyticsCollector */
    protected $collector;

    /**
     * Constructor.
     *
     * @param AnalyticsCollector $collector
     */
    public function __construct(AnalyticsCollector $collector)
    {
        $this->collector = $collector;
    }

    protected function handle(WP_REST_Request $request)
    {
        ignore_user_abort(true);

        $post = $request->get_param('post');
        if (!empty($post)) {
            $this->collector->addPostClick($post);
        }

        return new WP_REST_Response();
    }
}
