<?php

namespace Fogio\View;

class VariableFilters
{
    protected $_filters;

    public function __construct(&$filters)
    {
        $this->_filters = $filters;
    }

    public function __call($method, $args)
    {
        $this->_filters[$method] = $args;
    }

} 