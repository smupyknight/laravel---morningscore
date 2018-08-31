<?php

namespace MorningTrain\Foundation\Support\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MorningTrain\Foundation\Support\Eloquent\Relationships\BelongsToOne;
use MorningTrain\Foundation\Support\Eloquent\Relationships\MorphToOne;

trait Relationships
{

    /**
     * Define a polymorphic many-to-many relationship.
     *
     * @param  string $related
     * @param  string $name
     * @param  string $table
     * @param  string $foreignPivotKey
     * @param  string $relatedPivotKey
     * @param  string $parentKey
     * @param  string $relatedKey
     * @param  bool $inverse
     * @return MorphToOne
     */
    public function morphToOne($related, $name, $table = null, $foreignPivotKey = null,
                               $relatedPivotKey = null, $parentKey = null,
                               $relatedKey = null, $inverse = false)
    {
        $caller = $this->guessBelongsToManyRelation();

        // First, we will need to determine the foreign key and "other key" for the
        // relationship. Once we have determined the keys we will make the query
        // instances, as well as the relationship instances we need for these.
        $instance = $this->newRelatedInstance($related);

        $foreignPivotKey = $foreignPivotKey ?: $name . '_id';

        $relatedPivotKey = $relatedPivotKey ?: $instance->getForeignKey();

        // Now we're ready to create a new query builder for this related model and
        // the relationship instances for this relation. This relations will set
        // appropriate query constraints then entirely manages the hydrations.
        $table = $table ?: Str::plural($name);

        return new MorphToOne(
            $instance->newQuery(), $this, $name, $table,
            $foreignPivotKey, $relatedPivotKey, $parentKey ?: $this->getKeyName(),
            $relatedKey ?: $instance->getKeyName(), $caller, $inverse
        );
    }

    /**
     * Define a polymorphic, inverse many-to-many relationship.
     *
     * @param  string $related
     * @param  string $name
     * @param  string $table
     * @param  string $foreignPivotKey
     * @param  string $relatedPivotKey
     * @param  string $parentKey
     * @param  string $relatedKey
     * @return MorphToOne
     */
    public function morphedByOne($related, $name, $table = null, $foreignPivotKey = null,
                                 $relatedPivotKey = null, $parentKey = null, $relatedKey = null)
    {
        $foreignPivotKey = $foreignPivotKey ?: $this->getForeignKey();

        // For the inverse of the polymorphic many-to-many relations, we will change
        // the way we determine the foreign and other keys, as it is the opposite
        // of the morph-to-many method since we're figuring out these inverses.
        $relatedPivotKey = $relatedPivotKey ?: $name . '_id';

        return $this->morphToOne(
            $related, $name, $table, $foreignPivotKey,
            $relatedPivotKey, $parentKey, $relatedKey, true
        );
    }

    /**
     * Define a many-to-many relationship.
     *
     * @param  string $related
     * @param  string $table
     * @param  string $foreignPivotKey
     * @param  string $relatedPivotKey
     * @param  string $parentKey
     * @param  string $relatedKey
     * @param  string $relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function belongsToOne($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
                                 $parentKey = null, $relatedKey = null, $relation = null)
    {
        // If no relationship name was passed, we will pull backtraces to get the
        // name of the calling function. We will use that function name as the
        // title of this relation since that is a great convention to apply.
        if (is_null($relation)) {
            $relation = $this->guessBelongsToManyRelation();
        }

        // First, we'll need to determine the foreign key and "other key" for the
        // relationship. Once we have determined the keys we'll make the query
        // instances as well as the relationship instances we need for this.
        $instance = $this->newRelatedInstance($related);

        $foreignPivotKey = $foreignPivotKey ?: $this->getForeignKey();

        $relatedPivotKey = $relatedPivotKey ?: $instance->getForeignKey();

        // If no table name was provided, we can guess it by concatenating the two
        // models using underscores in alphabetical order. The two model names
        // are transformed to snake case from their default CamelCase also.
        if (is_null($table)) {
            $table = $this->joiningTable($related);
        }

        return $this->newBelongsToOne(
            $instance->newQuery(), $this, $table, $foreignPivotKey,
            $relatedPivotKey, $parentKey ?: $this->getKeyName(),
            $relatedKey ?: $instance->getKeyName(), $relation
        );
    }

    /**
     * Instantiate a new BelongsToMany relationship.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \Illuminate\Database\Eloquent\Model $parent
     * @param  string $table
     * @param  string $foreignPivotKey
     * @param  string $relatedPivotKey
     * @param  string $parentKey
     * @param  string $relatedKey
     * @param  string $relationName
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function newBelongsToOne(Builder $query, Model $parent, $table, $foreignPivotKey, $relatedPivotKey,
                                       $parentKey, $relatedKey, $relationName = null)
    {
        return new BelongsToOne($query, $parent, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relationName);
    }

}