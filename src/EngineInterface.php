<?php

namespace Fogio\View;

interface EngineInterface
{

    public function supports($template);

    public function render($template, $data);

}