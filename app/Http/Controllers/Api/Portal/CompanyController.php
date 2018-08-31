<?php

namespace App\Http\Controllers\Api\Portal;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MorningTrain\Foundation\Api\Controller;
use MorningTrain\Foundation\Api\Field;
use MorningTrain\Foundation\Api\Traits\PolicyAuthorization;
use Illuminate\Database\Eloquent\Model;


class CompanyController extends Controller
{
    use PolicyAuthorization;
    
    protected $model = Company::class;

    protected function fields(Model $model)
    {
        return [
            
            /////////////////////////////////
            // Keyword
            /////////////////////////////////
            
            Field::create('name')->validates('string|nullable'),
            Field::create('website')->validates('string|nullable'),
            Field::create('phone')->validates('string|max:32|nullable'),
            Field::create('country')->validates('string|nullable'),
            Field::create('city')->validates('string|nullable'),
            Field::create('zipcode')->validates('string|max:10|nullable'),
            Field::create('address')->validates('string|nullable'),
        ];
    }

    protected function modelResponse(Model $model)
    {
        return $model->makeHidden([
            'created_at',
            'updated_at',
        ]);
    }
}
