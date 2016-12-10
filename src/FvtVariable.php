<?php

namespace Fogio\View;

class FvtVariable implements \Iterator, \ArrayAccess
{
    protected $_____view;
    protected $_____val;
    protected $_____filter;

    public function __construct($view, $val, $filters)
    {
        $this->_____view = $view;
        $this->_____val = $val;
        $this->_____filter = $filters;
    }

    public function __toString()
    {
        return $this->val();
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __call($name, $args)
    {
        return new FvtVariable(
            $this->_____view,
            call_user_func_array([$this->_____view, $name],  array_merge([$this->_____val], $args)),
            $this->_____filter
        );
    }

    public function filters()
    {
        return new FvtVariableFilters($this->_____filter);
    }

    public function val()
    {
        $val = $this->_____val;
        foreach ($this->_____filter as $filter) {
            $val = call_user_func_array([$this->_____view, $filter['filter']], array_merge([$val], (array)$filter['arg']));
        }
        return $val;
    }

    public function get($name)
    {
        if (is_array($this->_____val)) {
            if (!is_object($this->_____val[$name]) && !$this->_____val[$name] instanceof FvtVariable) {
                $this->_____val[$name] = new FvtVariable($this->_____view, $this->_____val[$name], $this->_____filter);
            }
            return $this->_____val[$name];
        }
        if (is_object($this->_____val)) {
            if (!is_object($this->_____val->$name) || !$this->_____val->$name instanceof FvtVariable) {
                $this->_____val->$name = new FvtVariable($this->_____view, $this->_____val->name, $this->_____filter);
            }
            return $this->_____val->$name;
        }
    }

    public function raw()
    {
        return $this->_____val;
    }

    /* \Iterator */

    function rewind()
    {
        return $this->get(reset($this->_____val));
    }

    function current()
    {
        return $this->get(current($this->_____val));
    }

    function key()
    {
        return key($this->_____val);
    }

    function next()
    {
        return $this->get(next($this->_____val));
    }

    function valid()
    {
        return key($this->_____val) !== null;
    }
    
    /* \ArrayAccess */

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_____val[] = $value;
        } else {
            $this->_____val[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->_____val[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->_____val[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->_____val[$offset]) ? $this->_____val[$offset] : null;
    }

}
