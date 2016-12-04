<?php

namespace Fogio\View\Helper;

class Ucwords
{
    public function invoke($s)
    {
        return ucwords($s);
    }
}
