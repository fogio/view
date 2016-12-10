<?php

namespace Fogio\View\Helper;

class Implode
{
    public function invoke($pieces, $glue)
    {
        var_dump($pieces);
        var_dump($glue);

        return implode($glue, $pieces);
    }
}
