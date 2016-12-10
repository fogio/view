<?php

namespace Fogio\View;

use Fogio\Container\Container;

class Render extends Container
{
    protected $_view;
    protected $_resolver;
    protected $_queue = [];
    protected $_content;
    protected $_context;

    public function setView(ViewInterface $view)
    {
        $this->_view = $view;

        return $this;
    }

    public function setTemaplateResolver(TemplateResolverInterface $resolver)
    {
        $this->_resolver = $resolver;

        return $this;
    }

    public function append($template, $data = null)
    {
        $this->_queue[] = ['template' => $template, 'data' => $data];
    }

    public function unshift($template, $data = null)
    {
        array_unshift($this->_queue, ['template' => $template, 'data' => $data]);

        return $this;
    }

    public function shift()
    {
        return array_shift($this->_queue);
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getContext()
    {
        return $this->_context;
    }

    public function render($template = null, $data = null)
    {
        if ($template) {
            $this->unshift($template, $data);
        }

        while ($this->_context = $this->shift()) {
            $this->_content = $this->resolveEngine($this->_context['template'])
                                ->render($this->_context['template'], $this->_context['data']);
        }

        return $this->_content;
    }

    public function resolveEngine($template)
    {
        foreach ($this->_engine as $name) {
            $engine = $this->$name;
            if ($engine->supports($template)) {
                $this->_context['engine'] = $name;
                return $engine;
            }
        }

        $tpl = is_scalar($template)
             ? "`$template`"
             : is_object($template)
                ? "object instace of class `" . get_class($template) . "`"
                : '' ;
        throw new \LogicException("Template $tpl not supported");
    }

    protected function __factory($engine, $name)
    {
        if ($engine === null) {
            throw new \LogicException();
        }

        if ($engine instanceof TemplateResolverAwareInterface && $this->_resolver) {
            $engine->setTemaplateResolver($this->_resolver);
        }

        if ($engine instanceof ViewAwareInterface) {
            $engine->setView($this->_view);
        }

        return $engine;
    }

    protected function __engine()
    {
        return $this->_engine = $this->getIterator();
    }

}
