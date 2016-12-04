<?php

namespace Fogio\View;

class FvtVariableFilters
{
    protected $_filter;

    public function __construct(&$filters)
    {
        $this->_filter = $filters;
    }

    public function __call($method, $args)
    {
        $this->_filter[] = ['filter' => $method, 'arg' => $args];
    }

} 