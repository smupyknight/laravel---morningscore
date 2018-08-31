<?php

namespace MorningTrain\Foundation\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use MorningTrain\Foundation\Api\Contracts\Controller as ControllerContract;

abstract class Controller extends BaseController implements ControllerContract
{
    use DispatchesJobs, ValidatesRequests;

    /*
     -------------------------------
     Configuration
     -------------------------------
     */

    /**
     * @var string
     */
    protected $model;

    /**
     * @var FilterCollection
     */
    protected $filters;

    /**
     * @var Collection
     */
    protected $fields;

    /**
     * @return FilterCollection
     */
    protected function getFilters()
    {
        if (!isset($this->filters)) {
            $this->filters = $this->filters();

            if (is_array($this->filters)) {
                $this->filters = FilterCollection::create($this->filters);
            }
        }

        return $this->filters;
    }

    /**
     * @return Collection
     */
    protected function getFields(Model $model)
    {
        if (!isset($this->fields)) {
            $this->fields = collect($this->fields($model));
        }

        return $this->fields;
    }

    protected function checkAuthorization($action)
    {
        if (method_exists($this, 'authorize')) {
            $args = array_slice(func_get_args(), 1);
            $this->authorize($action, ...$args);
        }
    }

    /*
     -------------------------------
     Hooks
     -------------------------------
     */

    /**
     * @return array
     */
    protected function filters()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function fields(Model $model)
    {
        return [];
    }

    /**
     * Returns a new query
     * @return Builder
     */
    protected function query()
    {
        return (new $this->model)->newQuery();
    }

    protected function queryWithFilters()
    {
        $query = $this->query();
        $this->getFilters()->apply($query, request());

        return $query;
    }

    protected function collectionResponse(Collection $collection)
    {
        $response = [
            'collection' => $collection->map(function ($model) {
                return $this->modelResponse($model);
            })
        ];

        // Add filter metadata to response
        $metadata = $this->getFilters()->getMetadata();

        if (is_array($metadata)) {
            $response = array_merge($response, $metadata);
        }

        return $response;
    }

    protected function modelResponse(Model $model)
    {
        return $model;
    }

    /*
     -------------------------------
     Hooks
     -------------------------------
     */

    protected function applyParametersToQuery(Builder $query, ...$arguments)
    {
        return $query;
    }

    protected function applyParametersToModel(Model $model, ...$arguments)
    {
        return $model;
    }

    protected function beforeStore(Model $model)
    {
        // ...
    }

    protected function afterStore(Model $model)
    {
        // ...
    }

    protected function beforeDelete(Model $model)
    {
        // ...
    }

    protected function afterDelete(Model $model)
    {
        // ...
    }

    protected function processStore(Model $model, Request $request, bool $patch, ...$arguments)
    {
        // ...
    }

    /*
     -------------------------------
     Methods
     -------------------------------
     */

    protected function response($data, $status = 200, $headers = [], $options = 0)
    {
        return response()->json(
            $data instanceof Collection ?
                $this->collectionResponse($data) :
                $this->modelResponse($data),

            $status, $headers, $options
        );
    }

    protected function error($error, $code = 400)
    {
        Api::abort($error, $code);
    }

    protected function void()
    {
        return response()->json([], 200, [], JSON_FORCE_OBJECT);
    }

    protected function getPatchValidationRules(array $rules)
    {
        $patch_rules = [];

        foreach ($rules as $prop => $rule) {
            $patch_rules[$prop] = is_array($rule) ? array_merge(['sometimes'], $rule) : "sometimes|$rule";
        }

        return $patch_rules;
    }

    protected function performValidation(Model $model, Request $request, Collection $fields, bool $patch = false, ...$arguments)
    {
        // Compute validation rules
        $rules = [];

        foreach ($fields as $field) {
            $rule = $field->getValidationRules($model, $request);

            if (is_array($rule)) {
                $rules = array_merge($rules, $rule);
            }
        }

        // Convert validation rules if patch request
        if ($patch) {
            $rules = $this->getPatchValidationRules($rules);
        }

        // Validate
        $this->validate($request, $rules);
    }

    protected function store(Model $model, Request $request, bool $patch = false, ...$arguments)
    {
        // Process locally (hook)
        if ($status = $this->processStore($model, $request, $patch, ...$arguments)) {
            return $status;
        }

        // Get fields
        $fields = $this->getFields($model);

        // Validate
        $this->performValidation($model, $request, $fields, $patch, ...$arguments);

        // Update
        foreach ($fields as $field) {
            $field->update($model, $request, Field::BEFORE_SAVE);
        }

        // Save
        if ($status = $this->beforeStore($model)) {
            return $status;
        }

        $model->save();

        // Update (after)
        foreach ($fields as $field) {
            $field->update($model, $request, Field::AFTER_SAVE);
        }

        if ($status = $this->afterStore($model)) {
            return $status;
        }

        // Parameters
        $this->applyParametersToModel($model, ...$arguments);

        return $this->response($model);
    }

    /*
     -------------------------------
     Overrides
     -------------------------------
     */

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        $field = array_keys($errors) [0];
        $message = $errors[$field][0];

        return new JsonResponse([
            'error' => 'validation_failed',
            'message' => $message

        ], 422);
    }

    /*
     -------------------------------
     Routes
     -------------------------------
     */

    public function index(Request $request, ...$arguments)
    {
        $this->checkAuthorization('index', $this->model);
        $query = $this->queryWithFilters();
        $this->applyParametersToQuery($query, ...$arguments);

        return $this->response(
            $query->get()
        );
    }

    public function find(Request $request, ...$arguments)
    {
        $id = array_pop($arguments);
        $query = $this->query();
        $this->applyParametersToQuery($query, ...$arguments);
        $model = $query->find($id);

        if (is_null($model)) {
            return $this->error('Model not found', 404);
        }

        // Authorize
        $this->checkAuthorization('find', $model);

        return $this->response($model);
    }

    public function create(Request $request, ...$arguments)
    {
        $this->checkAuthorization('create', $this->model);
        return $this->store(new $this->model, $request, false, ...$arguments);
    }

    public function update(Request $request, ...$arguments)
    {
        $id = array_pop($arguments);
        $model = $this->applyParametersToQuery($this->query(), ...$arguments)->find($id);

        if (is_null($model)) {
            return $this->error('Model not found', 404);
        }

        // Authorize
        $this->checkAuthorization('update', $model);

        return $this->store($model, $request, true);
    }

    public function validation(Request $request, ...$arguments)
    {
        $id = array_pop($arguments);
        $model = $this->applyParametersToQuery($this->query(), ...$arguments)->find($id);

        if (is_null($model)) {
            return $this->error('Model not found', 404);
        }

        // Authorize
        $this->checkAuthorization('update', $model);

        $this->performValidation($model, $request, $this->getFields(), true, ...$arguments);

        return response()->json([
            'success' => true
        ]);
    }

    public function delete(Request $request, ...$arguments)
    {
        $id = array_pop($arguments);
        $model = $this->applyParametersToQuery($this->query())->find($id);

        if (is_null($model)) {
            return $this->error('Model not found', 404);
        }

        // Authorize
        $this->checkAuthorization('delete', $model);

        // Attempt delete  
        if ($status = $this->beforeDelete($model)) {
            return $status;
        }

        $model->delete();

        if ($status = $this->afterDelete($model)) {
            return $status;
        }

        return $this->void();
    }

}
