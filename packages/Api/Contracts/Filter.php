<?php

namespace MorningTrain\Foundation\Api\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface Filter
{

    /**
     * @return mixed
     */
    public function getMetadata();

    /**
     * @param Builder $query
     * @param Request $request
     * @return mixed
     */
    public function apply(Builder $query, Request $request = null);

}