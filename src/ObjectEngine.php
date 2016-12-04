<?php

namespace Fogio\View;

class ObjectEngine implements EngineInterface, ViewAwareInterface
{
    protected $view;

    public function setView(ViewInterface $view)
    {
        $this->view = $view;

        return $this;
    }

    public function supports($template)
    {
        return is_object($template) && $template instanceof ObjectTemplateInterface;
    }

    public function render(ObjectTemplateInterface $template, $data)
    {
        if ($template instanceof ViewAwareInterface) {
            $template->setView($this->view);
        }

        return $template->render($data);
    }

}
