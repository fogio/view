<?php

namespace Fogio\View\Helper;

class Date
{
    protected $format = 'Y-m-d H:i';

    public function setForamt($format)
    {
        $this->format = $format;

        return $this;
    }

    public function invoke($timestamp, $format = null)
    {
        if ($format === null) {
            $format = $this->format;
        }

        return date($format, $timestamp) ;
    }
}
