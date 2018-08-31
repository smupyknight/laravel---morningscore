<?php

namespace App\Support\Util;

abstract class Enum
{
    protected static $default;
    protected static $attributes = [];
    
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);
        
        return $reflection->getConstants();
    }
    
    public static function validate($value)
    {
        return in_array($value, static::all());
    }
    
    public static function name($value)
    {
        $flipped = array_flip(static::all());
        if (isset($flipped[$value])) {
            return $flipped[$value];
        }
        
        return $value;
    }
    
    public static function default()
    {
        if (isset(static::$default)) {
            return static::$default;
        }
        
        $all = static::all();
        
        return array_shift($all);
    }
    
    public static function attr($type, $attr = null)
    {
        if ($attr === null) {
            if (isset(static::$attributes[$type])) {
                return static::$attributes[$type];
            } else {
                return [];
            }
        } elseif (isset(static::$attributes[$type]) && isset(static::$attributes[$type][$attr])) {
            return static::$attributes[$type][$attr];
        }
        
        return static::name($type);
    }
    
    public static function each(\Closure $closure)
    {
        $entries = static::all();
        if (! empty($entries)) {
            foreach ($entries as $entry) {
                $closure($entry, static::attr($entry));
            }
        }
    }
}
