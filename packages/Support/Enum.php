<?php

namespace MorningTrain\Foundation\Support;

use Illuminate\Support\Str;

abstract class Enum
{
    static $namespace = 'enums';

    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    public static function values()
    {
        return array_values(static::all());
    }

    public static function validate($value)
    {
        return in_array($value, static::all());
    }

    public static function default()
    {
        if (isset(static::$default)) {
            return static::$default;
        }

        $all = static::all();
        return array_shift($all);
    }

    public static function namespace()
    {
        $classNameParts = explode('\\', static::class);
        $className = end($classNameParts);
        return static::$namespace . '.' . strtolower(Str::snake($className));
    }

    public static function options()
    {
        return array_reduce(static::values(), function ($acc, $value) {
            $acc[$value] = transOr(static::namespace() . '.' . $value, ucfirst(Str::studly($value)));
            return $acc;
        }, []);
    }
}