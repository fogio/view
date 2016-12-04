<?php

namespace Fogio\View;

interface ViewInterface
{
    public function render($tpl, $data);
}