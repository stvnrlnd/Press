<?php

namespace stvnrlnd\Press;

use Parsedown;

class MarkdownParser
{
    public static function parse($string)
    {
        return Parsedown::instance()->text($string);
    }
}
