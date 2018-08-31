<?php

namespace MorningTrain\Foundation\Api\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Field
{

    /**
     * @param Model $model
     * @return mixed
     */
    public function getValidationRules(Model $model);

    /**
     * @param Model $model
     * @param Request $request
     * @param string $timeline
     * @return mixed
     */
    public function update(Model $model, Request $request, string $timeline);

}