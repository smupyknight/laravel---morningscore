<?php

namespace MorningTrain\Foundation\Support\Eloquent\Relationships;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BelongsToOne extends BelongsToMany
{

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array $models
     * @param  string $relation
     * @return array
     */
    public function initRelation(array $models, $relation)
    {
        foreach ($models as $model) {
            $model->setRelation($relation, null);
        }

        return $models;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array $models
     * @param  \Illuminate\Database\Eloquent\Collection $results
     * @param  string $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
        $dictionary = $this->buildDictionary($results);

        // Once we have an array dictionary of child objects we can easily match the
        // children back to their parent using the dictionary and the keys on the
        // the parent models. Then we will return the hydrated models back out.
        foreach ($models as $model) {
            if (isset($dictionary[$key = $model->{$this->parentKey}])) {
                $model->setRelation(
                    $relation, $dictionary[$key][0] ?? null
                );
            }
        }

        return $models;
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->first();
    }

    /**
     * Associate instance
     *
     * @param $related
     * @param array $attributes
     */
    public function associate($related, array $attributes = [])
    {
        $this->dissociate();

        if (!is_null($related)) {
            $this->attach(is_object($related) ? $related->getKey() : $related);
        }
    }

    /**
     * Dissociate
     */
    public function dissociate()
    {
        $this->detach();
    }

}