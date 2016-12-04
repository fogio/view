<?php

namespace Fogio\View\Helper;

class Implode
{
    public function invoke($pieces, $glue)
    {
        return implode($glue, $pieces);
    }
}
