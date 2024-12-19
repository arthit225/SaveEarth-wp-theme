<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\Data;

class GrowthAnalytics
{
    /** @var int */
    public $thisPeriod = 0;

    /** @var int|null */
    public $lastPeriod = null;

    /** @var int */
    public $increase = 0;

    /** @var int */
    public $percent = 0;

    /** Constructor */
    public function __construct(int $thisPeriod = 0, ?int $lastPeriod = null)
    {
        $this->thisPeriod = $thisPeriod;
        $this->lastPeriod = $lastPeriod;
        $this->increase = $lastPeriod !== null
            ? $thisPeriod - $lastPeriod
            : 0;

        $this->calculatePercent();
    }

    public function calculatePercent(): float
    {
        return $this->percent = ($this->lastPeriod !== null && $this->lastPeriod > 0)
            ? ((float) $this->increase / (float) $this->lastPeriod) * 100.0
            : 0;
    }
}
