<?php

namespace MorningTrain\Foundation\Context\Plugins\Menus;

use MorningTrain\Foundation\Context\ContextService;
use MorningTrain\Foundation\Context\Contracts\Pluginable;
use \Closure;

class MenusPlugin implements Pluginable
{

    public function register(ContextService $context)
    {
        $context->extend('menu', function (...$arguments) {
            return $this->getMenu(...$arguments);
        });
    }

    /**
     * @var array
     */
    protected $menus = [];

    protected function getMenu(string $name, Closure $callback = null)
    {
        $menu = isset($this->menus[$name]) ?
            $this->menus[$name] :
            ($this->menus[$name] = new Menu());

        if ($callback instanceof Closure) {
            $callback($menu);
        }

        return $menu;
    }

}