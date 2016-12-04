<?php

namespace Fogio\View\Helper;

class Html
{
    public function invoke($s)
    {
        return htmlspecialchars($s);
    }
}
