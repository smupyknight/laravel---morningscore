<?php

namespace MorningTrain\Foundation\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use MorningTrain\Foundation\Api\Contracts\Field as FieldContract;
use MorningTrain\Foundation\Support\Traits\StaticCreate;
use \Closure;

class FieldCollection implements FieldContract
{
    use StaticCreate;

    public function __construct(string $name, array $collection = null)
    {
        $this->name = $name;

        if (is_array($collection)) {
            $this->setCollection($collection);
        }
    }

    /*
     -------------------------------
     Helpers
     -------------------------------
     */

    protected function prefixRequestName($name)
    {
        $nameParts = [];

        if (is_string($this->getRequestName())) {
            $nameParts[] = $this->getRequestName();
        }

        if (is_string($name)) {
            $nameParts[] = $name;
        }

        return count($nameParts) > 0 ? implode('.', $nameParts) : null;
    }

    protected function computeMergedRules($generalRule, $rule)
    {
        $ruleParts = [];

        if (is_string($generalRule)) {
            $ruleParts[] = $generalRule;
        }

        if (is_string($rule)) {
            $ruleParts[] = $rule;
        }

        return count($ruleParts) > 0 ? implode('|', $ruleParts) : null;
    }

    protected function getMergedRules(Model $model, $rules)
    {
        $generalRules = $this->getValidatorRules($model);

        return $this->computeMergedRules(
            $generalRules[$this->getRequestName()] ?? null,
            $rules
        );
    }

    protected function mergeRules($rules)
    {
        return function (Model $model) use ($rules) {
            return $this->getMergedRules($model, $rules);
        };
    }

    /*
     -------------------------------
     Collection
     -------------------------------
     */

    /**
     * @var Collection
     */
    protected $collection;

    protected function setCollection(array $collection)
    {
        $this->collection = collect($collection);
        return $this;
    }

    protected function appendField(FieldContract $field)
    {
        $this->collection->push($field);
        return $this;
    }

    /*
     -------------------------------
     Names
     -------------------------------
     */

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $requestName;

    /**
     * @var string
     */
    protected $propertyName;

    public function propertyName(string $name)
    {
        $this->propertyName = $name;
        return $this;
    }

    public function requestName(string $name)
    {
        $this->requestName = $name;
        return $this;
    }

    protected function getPropertyName()
    {
        return $this->propertyName ?: $this->name;
    }

    protected function getRequestName()
    {
        return $this->requestName ?: $this->name;
    }

    /*
     -------------------------------
     Validation
     -------------------------------
     */

    /**
     * @var string|array|Closure
     */
    protected $validator;

    public function validates($validator)
    {
        $this->validator = $validator;
        return $this;
    }

    protected function getValidator()
    {
        return $this->validator;
    }

    protected function processRules(Model $model, Model $resolvedModel, $rules)
    {
        return $rules;
    }

    protected function getValidatorRules(Model $model)
    {
        $validator = $this->getValidator();
        $rules = $validator instanceof Closure ? $validator($model) : $validator;
        return is_string($rules) ? [$this->getRequestName() => $rules] : $rules;
    }

    public function getValidationRules(Model $model)
    {
        $resolvedModel = $this->resolveModel($model, $this->getPropertyName());

        $rules = $this->collection->reduce(function ($acc, FieldContract $field) use ($resolvedModel) {
            $rules = $field->getValidationRules($resolvedModel);
            return is_array($rules) ? array_merge($acc, $rules) : $acc;
        }, []);

        return $this->processRules(
            $model,
            $resolvedModel,
            $rules
        );
    }

    /*
     -------------------------------
     Updates
     -------------------------------
     */

    /**
     * @var string
     */
    protected $updateTime = 'before';

    public function updatesAt(string $updateTime)
    {
        $this->updateTime = $updateTime;
        return $this;
    }

    protected function getUpdateTime()
    {
        return $this->updateTime;
    }

    protected function checkRequest(Request $request)
    {
        return $request->has($this->getRequestName()) && is_array($this->getRequestValue($request));
    }

    protected function getRequestValue(Request $request)
    {
        return $request->get($this->getRequestName());
    }

    protected function resolveModel(Model $model, $attribute)
    {
        return $model;
    }

    public function update(Model $model, Request $request, string $timeline)
    {
        if (($this->getUpdateTime() !== $timeline) && ($this->getUpdateTime() !== Field::BOTH)) {
            return;
        }

        if ($this->checkRequest($request)) {
            $resolvedModel = $this->resolveModel($model, $this->getPropertyName());

            $this->collection->each(function (FieldContract $field) use ($resolvedModel, $request, $timeline) {
                $field->update($resolvedModel, $request, $timeline);
            });

            // Update resolved model if not main one
            if ($model !== $resolvedModel) {
                $resolvedModel->save();
            }
        }
    }
}