<?php

namespace MorningTrain\Foundation\Api\Filters;

use Carbon\Carbon;
use \Exception;
use MorningTrain\Foundation\Api\Filter;

class DateFilter extends Filter
{

    /*
     -------------------------------
     Builders
     -------------------------------
     */

    public function on($column, $prefix = null)
    {
        if (is_null($prefix)) {
            $prefix = $column;
        }

        foreach ($this->getOperators() as $suffix => $operator) {
            $name = '$' . $prefix . '_' . $suffix;

            $this->when($name, function ($query, $value) use ($column, $name, $operator) {
                $value = $this->parseDate($name, $value);
                $query->where($column, $operator, $value);
            });
        }

        return $this;
    }

    public function timestamps()
    {
        return $this
            ->on('created_at', 'created')
            ->on('updated_at', 'updated');
    }

    /*
     -------------------------------
     Helpers
     -------------------------------
     */

    protected function getOperators()
    {
        return [
            'before' => '<',
            'after' => '>'
        ];
    }

    protected function parseDate($name, $value)
    {
        try {
            return Carbon::parse($value);
        } catch (Exception $ex) {
            throw new Exception("Invalid value for filter $name.");
        }
    }

}