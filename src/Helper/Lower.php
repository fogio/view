<?php

namespace Fogio\View\Helper;

class Lower
{
    public function invoke($s)
    {
        return mb_strtolower($s);
    }
}
