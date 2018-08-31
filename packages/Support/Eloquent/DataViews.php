<?php

namespace MorningTrain\Foundation\Support\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait DataViews
{

    /*
     -------------------------------
     Helpers
     -------------------------------
     */

    protected function getDataViewsDefinitions()
    {
        return $this->dataViews ?? [];
    }

    /*
     -------------------------------
     Scopes
     -------------------------------
     */

    public function scopePrepareView(Builder $q, string $viewName)
    {
        $views = $this->getDataViewsDefinitions();
        $view = $views[$viewName] ?? [];
        $relationships = $view['with'] ?? [];

        if (count($relationships) > 0) {
            $q->with($relationships);
        }
    }

    /*
     -------------------------------
     Renderer
     -------------------------------
     */

    public function toView(string $viewName)
    {
        $views = $this->getDataViewsDefinitions();
        $view = $views[$viewName] ?? [];

        $relationships = $view['with'] ?? [];
        $appends = $view['appends'] ?? [];
        $hidden = $view['hidden'] ?? [];

        $data = $this->toArray();

        // Add relationships
        foreach ($relationships as $relationship) {
            if (!$this->relationLoaded($relationship)) {
                $this->load($relationship);
            }

            $data[Str::snake($relationship)] = $this->$relationship;
        }

        // Add appends
        foreach ($appends as $append) {
            $data[$append] = $this->$append;
        }

        // Hide
        foreach ($hidden as $hide) {
            unset($data[$hide]);
        }

        return $data;
    }

}