<?php

namespace Fogio\View;

use Fogio\Container\Container;

class View extends Container implements ViewInterface
{

    public function render($template = null, $data = null)
    {
        return $this->render->render($template, $data);
    }

    protected function _render()
    {
        return $this->render = (new Render())
            ->setView($this)
            ->__invoke([
                'fvt' => FvtEngine::class,
                'php' => PhpEngine::class,
                'object' => ObjectEngine::class,
            ]);

    }

    protected function _html()
    {
        return $this->_html = new Helper\Html();
    }

    protected function _lower()
    {
        return $this->_lower = new Helper\Lower();
    }

    protected function _date()
    {
        return $this->_date = new Helper\Date();
    }

    protected function _implode()
    {
        return $this->_implode = new Helper\Implode();
    }

}
