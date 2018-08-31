<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\SubscriptionTemplate;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MorningTrain\Foundation\Api\Controller;
use MorningTrain\Foundation\Api\Field;
use MorningTrain\Foundation\Api\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Api\Fields\BooleanField;

class SubscriptionTemplateController extends Controller
{
    protected $model = SubscriptionTemplate::class;

    protected function fields(Model $model)
    {
        return [
            
            /////////////////////////////////
            // Slug
            /////////////////////////////////
            
            Field::create('slug')->validates('required|unique:subscription_templates,slug|alpha_dash'),
            
            /////////////////////////////////
            // Is Deafult
            /////////////////////////////////
            
            BooleanField::create('is_default'),
            // BooleanField::create('is_default')->validates('boolean'), // doesn't support form data
        ];
    }
    
    protected function filters()
    {
        return [
            Filter::create()
                // Add featureables and features
                ->when('$withfeatures', function (Builder $query) {
                    $query->with('features');
                })
        ];
    }
    
    protected function afterStore(Model $model)
    {
        // Ensure only one default exists
        if ($model->is_default) {
            SubscriptionTemplate::where('id', '<>', $model->id)
                ->update(['is_default' => false]);
        }
    }
    
    protected function beforeDelete(Model $model)
    {
        // Ensure a default template exists
        if ($model->is_default) {
            return abort(400, 'Can\'t delete default template');
        }
    }

    
    /*
     -------------------------------
     Features
     -------------------------------
     */

    
    public function getFeatures(Request $request, $subscriptionTemplateId)
    {
        $template = $this->query()->where('id', $subscriptionTemplateId)->first();

        if ($template === null) {
            return abort(400, 'Template doesn\'t exist');
        }
        
        return $template->features->makeVisible('quantity');
    }
    
    public function attachFeature(Request $request, $subscriptionTemplateId, $featureId)
    {
        $this->validate($request, ['quantity' => 'numeric']);
        $template = $this->query()->where('id', $subscriptionTemplateId)->first();

        if ($template === null) {
            return abort(400, 'Template doesn\'t exist');
        }
        
        if (! Feature::where('id', $featureId)->exists()) {
            return abort(400, 'Feature doesn\'t exist');
        }
        
        $quantity = $request->input('quantity');
        if ($quantity === null)
        {
            $quantity = 0;
        }
        
        $template->features()->syncWithoutDetaching([$featureId => ['quantity' => $quantity]]);
        return $template->features()->where('id', $featureId)->first()->makeVisible('quantity');
    }
    
    public function detachFeature(Request $request, $subscriptionTemplateId, $featureId)
    {
        $template = $this->query()->where('id', $subscriptionTemplateId)->first();

        if ($template === null) {
            return abort(400, 'Template doesn\'t exist');
        }
        
        return $template->features()->detach($featureId);
    }
}
