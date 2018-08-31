<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MorningTrain\Foundation\Api\Controller;
use MorningTrain\Foundation\Api\Field;
use App\Api\Fields\BooleanField;
use MorningTrain\Foundation\Api\Filters\PaginationFilter;

class FeatureController extends Controller
{
    protected $model = Feature::class;
    
    protected function fields(Model $model)
    {
        return [
            
            /////////////////////////////////
            // Slug
            /////////////////////////////////
            
            Field::create('slug')->validates('required|unique:features,slug|alpha_dash'),
            
            /////////////////////////////////
            // Is Deafult
            /////////////////////////////////
            
            BooleanField::create('is_public')->validates('required'),
            // BooleanField::create('is_public')->validates('required|boolean'), // doesn't support form data
        ];
    }
    
    protected function filters()
    {
        return [
            PaginationFilter::create()
                ->shows(10),
        ];
    }
}
