<?php

namespace Fogio\View\Helper;

class Cut
{
    public function invoke($s, $maxLength, $end)
    {
        if (mb_strlen($s) <= $maxLength) {
            return $s;
        }

        return mb_substr($s, 0, $maxLength) . $end;
    }
}
