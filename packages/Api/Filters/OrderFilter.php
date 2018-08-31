<?php

namespace MorningTrain\Foundation\Api\Filters;

use MorningTrain\Foundation\Api\Filter;

class OrderFilter extends Filter
{

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @param string|array $columns
     * @return $this
     */
    public function only($columns)
    {
        $this->columns = array_merge($this->columns, (array)$columns);
        return $this;
    }

    protected function validateColumn($column)
    {
        return empty($this->columns) || in_array($column, $this->columns);
    }

    protected function getOrdersFromQueryInput($input)
    {
        // Single column
        if (is_string($input) && $this->validateColumn($input)) {
            return [
                [
                    'column' => $input,
                    'direction' => 'asc'
                ]
            ];
        }

        // Multiple columns
        if (is_array($input)) {
            $orders = [];

            foreach ($input as $column => $direction) {
                if ($this->validateColumn($column)) {
                    $orders[] = [
                        'column' => $column,
                        'direction' => in_array(strtolower($direction), ['asc', 'desc']) ?
                            $direction :
                            'asc'
                    ];
                }
            }

            if (!empty($orders)) {
                return $orders;
            }
        }
    }

    public function __construct()
    {
        $this->when('$order', function ($query, $input) {
            $orders = $this->getOrdersFromQueryInput($input);

            if (is_array($orders)) {
                $this->appliedOrders = $orders;
                foreach ($orders as $order) {
                    $query->orderBy($order['column'], $order['direction']);
                }
            }
        });
    }

    protected $appliedOrders;

    public function getMetadata()
    {
        if (is_array($this->appliedOrders)) {
            return [
                'order' => $this->appliedOrders
            ];
        }
    }

}