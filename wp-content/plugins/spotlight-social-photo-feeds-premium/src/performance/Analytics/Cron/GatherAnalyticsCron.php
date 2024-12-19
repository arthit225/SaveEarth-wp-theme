<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\Cron;

use RebelCode\Iris\Utils\Marker;
use RebelCode\Spotlight\Instagram\Performance\Analytics\AnalyticsCollector;
use RebelCode\Spotlight\Instagram\Wp\CronJob;

class GatherAnalyticsCron
{
    /** @var CronJob */
    protected $cronJob;

    /** @var string */
    protected $cronTime;

    /** @var AnalyticsCollector */
    protected $collector;

    /** @var Marker */
    protected $isRunningMarker;

    /**
     * Constructor.
     *
     * @param CronJob $cronJob The cron job instance, to reschedule it after analytics have been collected.
     * @param string $cronTime A time string ("H:i") with the time of day when the cron should run.
     * @param AnalyticsCollector $collector The analytics collector.
     * @param Marker $isRunningMarker The marker to use to record whether the cron is running.
     */
    public function __construct(
        CronJob $cronJob,
        string $cronTime,
        AnalyticsCollector $collector,
        Marker $isRunningMarker
    ) {
        $this->cronJob = $cronJob;
        $this->cronTime = $cronTime;
        $this->collector = $collector;
        $this->isRunningMarker = $isRunningMarker;
    }

    /** The cron handler. */
    public function __invoke(): void
    {
        // Whether the cron was able to finish collection
        $didFinish = false;
        // Performs cleanup after analytics have been collected. MUST be run after collection
        $cleanup = function () {
            $this->isRunningMarker->delete();

            // If the time that the cron should run for today has already passed, the cron will be scheduled for
            // tomorrow. Otherwise, it will be scheduled for today.
            $day = time() > strtotime('Today ' . $this->cronTime) ? 'Tomorrow' : 'Today';

            CronJob::schedule($this->cronJob, strtotime("$day $this->cronTime"));
        };

        // When the PHP process shuts down, ensure that the cleanup routine was run. Example: If a fatal error occurred
        // during collection, the cleanup routine may be skipped.
        register_shutdown_function(function () use ($cleanup, $didFinish) {
            if (!$didFinish) {
                $cleanup();
            }
        });

        try {
            $this->isRunningMarker->create();
            $this->collector->collect();
        } finally {
            $cleanup();
            $didFinish = true;
        }
    }
}
