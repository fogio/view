<?php

namespace Fogio\View;

class PhpEngine implements EngineInterface, ViewAwareInterface, TemplateResolverAwareInterface
{
    protected $suffix = '.php'; // as - Alternative syntax for control structures
    protected $resolver;
    protected $view;

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
        $_____data['view'] = $this->view;

        if ($this->resolver) {
            $_____tpl = $this->resolver->resolve($_____tpl);
        }

        unset($_____data['this'], $data, $template);

        extract($_____data, EXTR_SKIP);

        ob_start();
        require $_____tpl;

        return ob_get_clean();
    }

}
