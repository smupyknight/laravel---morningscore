<?php

namespace MorningTrain\Foundation\Api\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use MorningTrain\Foundation\Api\Field;

class PasswordField extends Field
{

    public function __construct(string $name = 'password')
    {
        parent::__construct($name);

        /////////////////////////////////
        // Validation
        /////////////////////////////////

        $this->validates(function (Model $model) {
            return ($model->id ? '' : 'required|') . 'string|min:6';
        });
    }

    /*
     -------------------------------
     Helpers
     -------------------------------
     */

    protected function hash(string $password)
    {
        return Hash::make($password);
    }


    /*
     -------------------------------
     Overrides
     -------------------------------
     */

    protected function processValue(Model $model, $value)
    {
        return parent::processValue($model, $this->hash($value));
    }

}