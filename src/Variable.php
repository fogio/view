<?php

namespace Fogio\View;

class Variable 
{
    protected $_view;
    protected $_val;
    protected $_filters;

    public function __construct($view, $val, $filters)
    {
        $this->_view = $view;
        $this->_val = $val;
        $this->_filters = $filters;
    }

    public function __toString()
    {
        return $this->val();
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function filters()
    {
        return new VariableFilters($this->_filters);
    }

    public function val()
    {
        $val = $this->_val;
        foreach ($this->_filters as $filter => $args) {
            $val = call_user_func([$this->_view, $filter], $args);
        }
        return $val;
    }

    public function get($name)
    {
        if (is_array($this->_val)) {
            if (!is_object($this->_val[$name]) || !$this->_val[$name] instanceof Variable) {
                $this->_val[$name] = new Variable($this, $this->_val[$name], $this->_filters);
            }
            return $this->_val[$name];
        }
        if (is_object($this->_val)) {
            if (!is_object($this->_val->$name) || !$this->_val->$name instanceof Variable) {
                $this->_val->$name = new Variable($this, $this->_val->name, $this->_filters);
            }
            return $this->_val->$name;
        }
    }

    public function raw()
    {
        return $this->_val;
    }

    /* Iterator */

    function rewind()
    {
        return $this->get(reset($this->_val));
    }

    function current()
    {
        return $this->get(current($this->_val));
    }

    function key()
    {
        return key($this->_val);
    }

    function next()
    {
        return $this->get(next($this->_val));
    }

    function valid()
    {
        return key($this->_val) !== null;
    }    

} 