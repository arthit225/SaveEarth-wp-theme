<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics\Data;

use DateTime;

class GraphAnalytics
{
    public const DAYS = 'days';
    public const WEEKS = 'weeks';
    public const MONTHS = 'months';
    public const YEARS = 'years';

    /** @var int[] */
    public $data;

    /**
     * @see self::DAY
     * @see self::MONTH
     * @see self::YEAR
     *
     * @var string
     */
    public $step;

    /**
     * Constructor.
     *
     * @param int[] $data An associative array that maps date strings (x-axis) to the data point values (y-axis).
     * @param string|null $step The step that is used in the graph. See the constants in this class.
     */
    public function __construct(array $data, string $step)
    {
        $this->data = $data;
        $this->step = $step;
    }

    /**
     * Creates an empty graph using a given a date range and optional step.
     *
     * @param int $start The start date.
     * @param int $end The end date.
     * @param string|null $step Optional step. If not given or null, it will be auto-detected.
     * @param int|null $value Optional value to use for all point in the graph. Defaults to null, indicating "no data".
     * @return GraphAnalytics The graph, with all values set to the given value.
     */
    public static function createEmpty(int $start, int $end, ?string $step = null, ?int $value = null): GraphAnalytics
    {
        $step = $step ?? static::autoDetectStep($start, $end);
        $dates = static::generateDatesRange($start, $end, $step);
        $dateFormat = static::getStepDateFormat($step);

        $data = [];
        foreach ($dates as $date) {
            $label = date($dateFormat, $date);
            $data[$label] = $value;
        }

        return new GraphAnalytics($data, $step);
    }

    /** Auto-detects the step needed for a given time range. */
    public static function autoDetectStep(int $start, int $end): string
    {
        $startDt = new DateTime();
        $startDt->setTimestamp($start);

        $endDt = new DateTime();
        $endDt->setTimestamp($end);

        $diff = $endDt->diff($startDt);

        if ($diff->y > 2) {
            return GraphAnalytics::YEARS;
        } elseif ($diff->m >= 4) {
            return GraphAnalytics::MONTHS;
        } elseif ($diff->days >= 35) {
            return GraphAnalytics::WEEKS;
        } else {
            return GraphAnalytics::DAYS;
        }
    }

    /**
     * Generates the dates to be used in the graph's X-axis, given a date range and optional step.
     *
     * @param int $start The start date.
     * @param int $end The end date.
     * @param string|null $step Optional step. If not given or null, it will be auto-detected.
     * @return int[] The list of dates, each in timestamp form.
     */
    public static function generateDatesRange(int $start, int $end, ?string $step = null): array
    {
        $step = $step ?? static::autoDetectStep($start, $end);

        $result = [];
        $curr = $start;

        while ($curr < $end) {
            $result[] = $curr;
            $curr = strtotime("+1 {$step}", $curr);
        }

        return $result;
    }

    /**
     * Gets the date format that is used to format dates for graph values. After being formatted into strings, the
     * dates are used as array keys in the graph data. The date formats should therefore generate strings that
     * uniquely identify the date element represented by the step.
     * For example:
     * The keys for graph data with a {@link GraphAnalytics::DAYS} step are strings that identify dates uniquely.
     *
     * @param string $step The step value, one of the constants in {@link GraphAnalytics}.
     * @return string The date format.
     */
    public static function getStepDateFormat(string $step): string
    {
        switch ($step) {
            default:
            case static::DAYS:
                return 'j M';
            case static::WEEKS:
                return '\W\e\e\k #W';
            case static::MONTHS:
                return 'M \'y';
            case static::YEARS:
                return 'Y';
        }
    }
}
