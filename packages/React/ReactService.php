<?php

namespace MorningTrain\Foundation\React;

use MorningTrain\Foundation\Context\Context;
use MorningTrain\Foundation\Support\Traits\ConfiguresProperties;
use \Closure;

class ReactService
{
    use ConfiguresProperties;

    /**
     * @var string
     */
    protected $host = 'http://localhost:3000';

    /**
     * @var string
     */
    protected $namespace = '';

    /**
     * This determines whether we render server side or not
     *
     * @var bool
     */
    protected $markup = false;

    /**
     * This determines whether we use the caching when rendering server side
     *
     * @var bool
     */
    protected $cache = false;

    /**
     * Environment object / getter
     *
     * @var mixed
     */
    protected $env;

    /**
     * This stores the configurable property names (see PropertyConfiguration trait)
     *
     * @var array
     */
    protected $configurable = [
        'host',
        'namespace',
        'markup',
        'cache',
        'env'
    ];

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @var Cache
     */
    protected $cacher;

    /**
     * @var array
     */
    protected $references = [];

    public function __construct(array $config = [])
    {
        $this->config($config);
    }

    protected function getRenderer()
    {
        return $this->renderer ?: ($this->renderer = new Renderer($this->host));
    }

    protected function getCache()
    {
        return $this->cacher ?: ($this->cacher = new Cache());
    }

    protected function getEnv()
    {
        $env = $this->env;

        if ($env instanceof \Closure) {
            return $env();
        }

        return is_array($env) || is_object($env) ? $env : [];
    }

    protected function toHtmlAttributesString(array $array)
    {
        $htmlAttributesString = '';
        foreach ($array as $attribute => $value) {
            $htmlAttributesString .= "{$attribute}='{$value}'";
        }
        return $htmlAttributesString;
    }

    protected function getQualifiedReferenceId(string $id)
    {
        $qualifiedId = $id;

        if (strlen($this->namespace) > 0) {
            $qualifiedId = $this->namespace . '.' . $qualifiedId;
        }

        return $qualifiedId;
    }

    public function component(string $component, array $props = [], array $options = [])
    {
        $options = array_merge([
            'tag' => 'div',
            'markup' => $this->markup,
            'ref' => null,
            'class' => 'react-component'

        ], $options);

        // Prepare vars
        if (strlen($this->namespace) > 0) {
            $component = $this->namespace . '.' . $component;
        }

        $tag = $options['tag'];
        $ref = $options['ref'];

        $markup = '';

        if ($options['markup']) {
            $markup = $this->getRenderer()->getMarkup($component, $props, $this->getEnv());
        }

        $props = htmlentities(json_encode($props), ENT_QUOTES);

        $attrs = $this->toHtmlAttributesString(array_except($options, ['tag', 'markup', 'ref']));

        return "<{$tag} data-react-class=\"$component\" data-react-props=\"$props\" data-react-ref=\"$ref\" $attrs>$markup</$tag>";
    }

    public function define(string $id, $cache, Closure $resolver)
    {
        $this->references[$this->getQualifiedReferenceId($id)] = [
            'cache' => $cache,
            'resolver' => $resolver
        ];

        return $this;
    }

    public function render(string $id, ...$arguments)
    {
        $qualifiedId = $this->getQualifiedReferenceId($id);

        if (!isset($this->references[$qualifiedId])) {
            throw new \Exception(sprintf('Cannot find component with reference `%s`.', $id));
        }

        $cache = $this->references[$qualifiedId]['cache'];
        $resolver = $this->references[$qualifiedId]['resolver'];

        if ($this->cache) {
            if ($cache instanceof Closure) {
                $cache = $cache(...$arguments);
            }

            if ($contents = $this->getCache()->getContents($qualifiedId, $cache)) {
                return $contents;
            }
        }

        // Resolve arguments
        $args = $resolver(...$arguments);

        if (!is_array($args) || !isset($args['component'])) {
            throw new \Exception(sprintf('Cannot resolve component referenced as `%s` because it does not return proper arguments.', $id));
        }

        $options = $args['options'] ?? [];
        $markup = $options['markup'] ?? $this->markup;
        $contents = $this->component($args['component'], $args['props'] ?? [], $options);

        if ($this->cache && $markup && $this->getRenderer()->isActive()) {
            $this->getCache()->setContents($qualifiedId, $contents, $cache);
        }

        return $contents;
    }

    public function clearCache(string $pattern = null)
    {
        foreach ($this->references as $qualifiedId => $options) {
            if (is_null($pattern) || fnmatch($pattern, $qualifiedId)) {
                $this->getCache()->removeContents($qualifiedId);
            }
        }

        return $this;
    }

}