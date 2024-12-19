<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\RestApi;

use DateTime;
use RebelCode\Iris\Utils\Marker;
use RebelCode\Spotlight\Instagram\Config\ConfigEntry;
use RebelCode\Spotlight\Instagram\RestApi\EndPoints\AbstractEndpointHandler;
use RebelCode\Spotlight\Instagram\Wp\CronJob;
use WP_REST_Request;
use WP_REST_Response;

/**
 * The endpoint that retrieves the timestamp of the next automatic analytics update, and the time of the last automatic
 * analytic update.
 */
class GetAnalyticsCronInfoEndPoint extends AbstractEndpointHandler
{
    /** @var CronJob */
    protected $cronJob;

    /** @var ConfigEntry */
    protected $lastUpdateCfg;

    /** @var Marker */
    protected $isRunningMarker;

    /** Constructor.*/
    public function __construct(CronJob $cronJob, ConfigEntry $lastUpdateCfg, Marker $isRunningMarker)
    {
        $this->cronJob = $cronJob;
        $this->lastUpdateCfg = $lastUpdateCfg;
        $this->isRunningMarker = $isRunningMarker;
    }

    /** @inerhitDoc */
    protected function handle(WP_REST_Request $request): WP_REST_Response
    {
        $nextEvent = CronJob::getScheduledEvent($this->cronJob);
        $nextTimestamp = ($nextEvent === false) ? 0 : $nextEvent->timestamp;

        $lastTimestamp = $this->lastUpdateCfg->getValue();

        // Set the PHP timezone to be WordPress' settings timezone
        date_default_timezone_set(wp_timezone()->getName());

        return new WP_REST_Response([
            // Return as ISO 8601 strings. The 'c' format includes the timezone
            'nextUpdate' => date('c', $nextTimestamp),
            'lastUpdate' => date('c', $lastTimestamp),
            'isRunning' => $this->isRunningMarker->isSet(),
        ]);
    }
}
