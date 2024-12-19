<?php

namespace RebelCode\Spotlight\Instagram\Performance\Analytics;

use RebelCode\Atlas\Expression\ExprInterface;
use RebelCode\Atlas\Table;

class DataPoint
{
    /** @var Table */
    public $table;

    /** @var ExprInterface|null */
    public $where;

    /** @var string */
    public $column;

    /**
     * Constructor.
     *
     * @param Table $table
     * @param ExprInterface|null $where
     * @param string $column
     */
    public function __construct(Table $table, ?ExprInterface $where, string $column)
    {
        $this->table = $table;
        $this->where = $where;
        $this->column = $column;
    }
}
