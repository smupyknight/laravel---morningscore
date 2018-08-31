<?php

namespace MorningTrain\Foundation\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use MorningTrain\Foundation\Api\Contracts\Filter as FilterContract;
use MorningTrain\Foundation\Support\Traits\StaticCreate;

class FilterCollection implements FilterContract
{
    use StaticCreate;

    /**
     * @var Collection
     */
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = collect($filters);
    }

    public function apply(Builder $query, Request $request = null)
    {
        foreach ($this->filters as $filter) {
            $filter->apply($query, $request);
        }
    }

    public function getMetadata()
    {
        $metadata = [];

        foreach ($this->filters as $filter) {
            $meta = $filter->getMetadata();

            if (is_array($meta)) {
                $metadata = array_merge($metadata, $meta);
            }
        }

        return $metadata;
    }

    public function collection()
    {
        return $this->filters;
    }

}