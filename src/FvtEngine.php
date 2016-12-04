<?php

namespace Fogio\View;

class FvtEngine implements EngineInterface, ViewAwareInterface, TemplateResolverAwareInterface
{
    protected $suffix = '.f.php'; // f - Fogio View Templating
    protected $resolver;
    protected $view;
    protected $filter = [['filter' => 'html', 'arg' => null]];

    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    public function setTemaplateResolver(TemplateResolverInterface $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    public function setView(ViewInterface $view)
    {
        $this->view = $view;

        return $this;
    }

    public function setFilters(\Closure $callback)
    {
        $callback(new FvtVariableFilters($this->filter));
    }

    public function supports($template)
    {
        if (!is_string($template)) {
            return false;
        }

        if ($this->resolver) {
            $template = $this->resolver->resolve($template);
        }

        return $this->suffix === substr($template, -strlen($this->suffix));
    }

    public function render($template, $data)
    {
        $_____data = $data;
        $_____tpl  = $template;

        if ($this->resolver) {
            $_____tpl = $this->resolver->resolve($_____tpl);
        }

        unset($_____data['this'], $data, $template);

        foreach ($_____data as $_____k => $_____v) {
            $$_____k = new FvtVariable($this->view, $_____v, $this->filter);
        }

        $view = $this->view;

        ob_start();
        require $_____tpl;

        return ob_get_clean();
    }

}
