<?php

namespace MorningTrain\Foundation\Format;

use \Closure;
use \Exception;

class FormatService
{

    /**
     * @var array
     */
    protected $formatters = [];

    /**
     * @param string $accessor
     * @param Closure $format
     * @return $this
     */
    public function define(string $accessor, Closure $format)
    {
        $this->formatters[$accessor] = $format;
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (!isset($this->formatters[$name])) {
            throw new Exception("Formatter `{$name}` is not defined!");
        }

        $format = $this->formatters[$name];

        return $format(...$arguments);
    }


}