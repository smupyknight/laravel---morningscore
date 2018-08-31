<?php

namespace MorningTrain\Foundation\Api;

use \Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use MorningTrain\Foundation\Api\Exceptions\ApiException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Api
{

    public static function route(string $namespace, array $options = [], Closure $group = null)
    {
        $namespaceParts = explode('.', $namespace);
        $entityName = end($namespaceParts);

        // Prepare prefix
        if (!isset($options['prefix'])) {
            $options['prefix'] = Str::plural($entityName);
        }

        // Prepare controller
        if (!isset($options['controller'])) {
            $options['controller'] = Str::studly(Str::singular($entityName)) . 'Controller';
        }

        // Prepare only parameter
        if (!isset($options['only']) || !is_array($options['only'])) {
            $options['only'] = ['index', 'find', 'create', 'update', 'delete', 'validate'];
        }

        // Prepare ID parameter name
        if (!isset($options['id'])) {
            $options['id'] = Str::snake(Str::singular($entityName)) . '_id';
        }

        // Create routes
        Route::group(['prefix' => $options['prefix']], function () use ($namespace, $options, $group) {
            // index
            if (in_array('index', $options['only'])) {
                Route::get('', [
                    'as' => "$namespace.index",
                    'uses' => $options['controller'] . '@index'
                ]);
            }

            // find
            if (in_array('find', $options['only'])) {
                Route::get('{' . $options['id'] . '}', [
                    'as' => "$namespace.find",
                    'uses' => $options['controller'] . '@find'
                ]);
            }

            // create
            if (in_array('create', $options['only'])) {
                Route::post('', [
                    'as' => "$namespace.create",
                    'uses' => $options['controller'] . '@create'
                ]);
            }

            // validate
            if (in_array('validate', $options['only'])) {
                Route::post('{' . $options['id'] . '}/validate', [
                    'as' => "$namespace.validate",
                    'uses' => $options['controller'] . '@validation'
                ]);
            }

            // update
            if (in_array('update', $options['only'])) {
                Route::post('{' . $options['id'] . '}', [
                    'as' => "$namespace.update",
                    'uses' => $options['controller'] . '@update'
                ]);
            }

            // delete
            if (in_array('delete', $options['only'])) {
                Route::delete('{' . $options['id'] . '}', [
                    'as' => "$namespace.delete",
                    'uses' => $options['controller'] . '@delete'
                ]);
            }

            if (!is_null($group)) {
                $group($namespace, $options['controller'], $options['id']);
            }
        });
    }

    public static function abort(string $message, $code = 400)
    {
        throw new ApiException($message, $code);
    }

}