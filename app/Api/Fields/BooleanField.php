<?php

namespace App\Api\Fields;

use Illuminate\Database\Eloquent\Model;
use MorningTrain\Foundation\Api\Field;

class BooleanField extends Field
{
    /*
     -------------------------------
     Overrides
     -------------------------------
     */

    protected function processValue(Model $model, $value)
    {
        return parent::processValue($model, filter_var($value, FILTER_VALIDATE_BOOLEAN));
    }

}