<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics;

use RebelCode\Atlas\Expression\ExprInterface;
use RebelCode\Atlas\Expression\Term;
use RebelCode\Atlas\Order;
use RebelCode\Spotlight\Instagram\Performance\Analytics\Data\GraphAnalytics;
use RebelCode\Spotlight\Instagram\Performance\Analytics\Data\GrowthAnalytics;
use RebelCode\Spotlight\Instagram\Performance\Analytics\Data\PromoClickSource;
use wpdb;

class AnalyticsProcessor
{
    /** @var AnalyticsTables */
    protected $tables;

    /** @var wpdb */
    protected $wpdb;

    /** Constructor. */
    public function __construct(wpdb $wpdb, AnalyticsTables $tables)
    {
        $this->wpdb = $wpdb;
        $this->tables = $tables;
    }

    /** Returns the data point for account followers. */
    public function followers(string $username): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->accounts(),
            $table->column('account')->equals($username),
            'followers'
        );
    }

    /** Returns the data point for the number of likes on all of an account's posts. */
    public function accountLikes(string $username): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->accounts(),
            $table->column('account')->equals($username),
            'likes'
        );
    }

    /** Returns the data point for the number of comments on all of an account's posts. */
    public function accountComments(string $username): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->accounts(),
            $table->column('account')->equals($username),
            'comments'
        );
    }

    /** Returns the data point for the number of likes on a post. */
    public function postLikes(string $postId): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->posts(),
            $table->column('post')->equals($postId),
            'likes'
        );
    }

    /** Returns the data point for the number of comments on a post. */
    public function postComments(string $postId): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->posts(),
            $table->column('post')->equals($postId),
            'comments'
        );
    }

    /** Returns the data point for the number of likes on all posts of a certain type. */
    public function typeLikes(string $type, string $username): DataPoint
    {
        $dp = new DataPoint(
            $table = $this->tables->posts(),
            $table->column('type')->equals($type)->and(
                $table->column('account')->equals($username)
            ),
            'likes'
        );

        if ($date = $this->getLatestDate($dp)) {
            $dp->where = $dp->where->and($table->column('date')->equals($date));
        }

        return $dp;
    }

    /** Returns the data point for the number of comments on all posts of a certain type. */
    public function typeComments(string $type, string $username): DataPoint
    {
        $dp = new DataPoint(
            $table = $this->tables->posts(),
            $table->column('type')->equals($type)->and(
                $table->column('account')->equals($username)
            ),
            'comments'
        );

        if ($date = $this->getLatestDate($dp)) {
            $dp->where = $dp->where->and($table->column('date')->equals($date));
        }

        return $dp;
    }

    /** Returns the data point for the number of clicks on a post. */
    public function postClicks(string $postId): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->engagement(),
            $table->column('post')->equals($postId),
            'clicks'
        );
    }

    /** Returns the data point for the number of clicks on all posts of a certain type. */
    public function typeClicks(string $type): DataPoint
    {
        return new DataPoint(
            $table = $this->tables->engagement(),
            $table->column('type')->equals($type),
            'clicks'
        );
    }

    /**
     * Returns the data point for the number of clicks on a promoted post.
     *
     * @param string $post The Instagram post ID.
     * @param string|null $source Optional source of the click. See the constants in {@link PromoClickSource}.
     * @param string|null $instance Optional feed instance.
     */
    public function promoClicks(string $post, ?string $source = null, ?string $instance = null): DataPoint
    {
        $table = $this->tables->promoAnalytics();
        $where = $table->column('post')->equals($post);

        if ($source) {
            $where = $where->and($table->column('source')->equals($source));
        }

        if ($instance) {
            $where = $where->and($table->column('instance')->equals($instance));
        }

        return new DataPoint($table, $where, 'clicks');
    }

    /**
     * Fetches the sum for a particular data point.
     *
     * @param DataPoint $dataPoint The data point.
     * @param int|null $start The starting timestamp of the period.
     * @param int|null $end The ending timestamp of the period.
     */
    public function getSum(DataPoint $dataPoint, ?int $start = null, ?int $end = null): int
    {
        $result = $this->wpdb->get_var(
            $dataPoint->table->select(
                [$dataPoint->table->column($dataPoint->column)->fn('SUM')],
                $this->whereDate($start, $end, $dataPoint->where)
            )
        );

        return (int) ($result ?? 0);
    }

    /**
     * Fetches the total of a particular data point.
     *
     * @param DataPoint $dataPoint The data point.
     * @param int|null $start The starting timestamp of the period.
     * @param int|null $end The ending timestamp of the period.
     *
     * @return int|null The latest value for a data point, or null if there are no records for the data point.
     */
    public function getLatest(DataPoint $dataPoint, ?int $start = null, ?int $end = null): ?int
    {
        $row = $this->wpdb->get_row(
            $dataPoint->table->select(
                [$dataPoint->column],
                $this->whereDate($start, $end, $dataPoint->where),
                [Order::by('date')->desc()],
                1
            )
        );

        if ($row === null) {
            return null;
        } else {
            return $row->{$dataPoint->column};
        }
    }

    /**
     * Calculates the growth rate of a particular data point in given time period.
     *
     * This is done by finding the total of the data point with that period and comparing it against the total of the
     * previous period.
     *
     * @param DataPoint $dataPoint The data point.
     * @param int|null $start The starting timestamp of the period.
     * @param int|null $end The ending timestamp of the period.
     */
    public function getGrowth(DataPoint $dataPoint, ?int $start = null, ?int $end = null): GrowthAnalytics
    {
        if ($start !== null && $end !== null) {
            [$pStart, $pEnd] = $this->getPreviousPeriod($start, $end);
            $numLastPeriod = $this->getLatest($dataPoint, $pStart, $pEnd);
        } elseif ($start !== null) {
            $numLastPeriod = $this->getLatest($dataPoint, null, $start);
        } else {
            $numLastPeriod = null;
        }

        $numThisPeriod = $this->getLatest($dataPoint, $start, $end) ?? 0;

        return new GrowthAnalytics($numThisPeriod, $numLastPeriod);
    }

    /**
     * Retrieves graph data for a data point in a given period.
     *
     * @param DataPoint $dataPoint The data point.
     * @param int|null $start The timestamp for the start of the range.
     * @param int|null $end The timestamp for the end of the range.
     * @param string|null $step Optional step for the graph's x-axis. See the constants in {@link GraphAnalytics}.
     *                          If null, the step will be automatically detected.
     */
    public function getGraph(DataPoint $dataPoint, ?int $start, ?int $end, string $step = null): GraphAnalytics
    {
        $rows = $this->wpdb->get_results(
            $dataPoint->table->select(
                ['*'],
                $this->whereDate($start, $end, $dataPoint->where),
                [Order::by('date')->asc()]
            )
        );

        $start = $start ?? strtotime($rows[0]->date);
        $end = $end ?? strtotime($rows[count($rows) - 1]->date);

        $graph = GraphAnalytics::createEmpty($start, $end, $step);
        $keyFormat = GraphAnalytics::getStepDateFormat($graph->step);
        $rowKey = $dataPoint->column;

        foreach ($rows as $row) {
            $value = (int) $row->{$rowKey};
            $date = date($keyFormat, strtotime($row->date));

            $graph->data[$date] = max($graph->data[$date] ?? 0, $value);
        }

        return $graph;
    }

    /**
     * Fetches the date of the latest entry for a particular data point.
     *
     * @param DataPoint $dataPoint The data point.
     *
     * @return string|null The value of the date column for the latest entry for a data point, or null if there are no
     *                     records for the data point.
     */
    public function getLatestDate(DataPoint $dataPoint): ?string
    {
        $row = $this->wpdb->get_row(
            $dataPoint->table->select(
                [$dataPoint->column],
                $dataPoint->where,
                [Order::by('date')->desc()],
                1
            )
        );

        if ($row === null) {
            return null;
        } else {
            return $row->date;
        }
    }

    /** Creates an expression that matches the 'date' column between the given constraints. */
    protected function whereDate(?int $start = null, ?int $end = null, ?ExprInterface $where = null): ?ExprInterface
    {
        if ($start !== null && $end !== null) {
            $whereDate = Term::column('date')->between($this->mySqlDate($start), $this->mySqlDate($end));
        } elseif ($start !== null) {
            $whereDate = Term::column('date')->gte($this->mySqlDate($start));
        } elseif ($end !== null) {
            $whereDate = Term::column('date')->lte($this->mySqlDate($end));
        } else {
            return $where;
        }

        return $where ? $where->and($whereDate) : $whereDate;
    }

    /** Formats a timestamp as a MySQL date. */
    protected function mySqlDate(int $timestamp): string
    {
        return gmdate('Y-m-d H:i:s', $timestamp);
    }

    /**
     * Creates a tuple with two timestamps that represent a period of time of same duration as the one given, but
     * shifted backwards in the past such that its ending timestamp is the given starting timestamp.
     *
     * @return array{0: int, 1: int}
     */
    protected function getPreviousPeriod(int $start, int $end): array
    {
        return [$start - $end + $start, $start];
    }
}
