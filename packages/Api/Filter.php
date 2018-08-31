<?php

namespace MorningTrain\Foundation\Api;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MorningTrain\Foundation\Support\Traits\StaticCreate;
use \Closure;
use \Exception;
use MorningTrain\Foundation\Api\Contracts\Filter as FilterContract;

class Filter implements FilterContract
{
    use StaticCreate;

    const PROVIDE_ALL = 'all';
    const PROVIDE_DEFAULT = 'default';

    /**
     * Case providers
     *
     * @var array
     */

    protected $providers = [];

    public function when($keys, Closure $closure)
    {
        $this->providers[] = [
            'keys' => (array)$keys,
            'apply' => $closure
        ];

        return $this;
    }

    public function always(Closure $closure)
    {
        return $this->when([], $closure);
    }

    public function getMetadata()
    {
        return [];
    }

    protected function getArguments(array $keys, Request $request = null)
    {
        if (empty($keys)) {
            return [];
        } else if (is_null($request)) {
            return false;
        }

        $args = [];
        foreach ($keys as $key) {
            if (!$request->has($key)) {
                return false;
            }

            $args[] = $request->get($key);
        }

        return $args;
    }

    public function apply(Builder $query, Request $request = null)
    {
        // Apply default providers
        foreach ($this->providers as $provider) {
            $args = $this->getArguments($provider['keys'], $request);

            if (is_array($args)) {
                $provider['apply'] ($query, ...$args);
            }
        }
    }

}