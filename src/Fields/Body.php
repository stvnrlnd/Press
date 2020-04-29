<?php

namespace stvnrlnd\Press\Fields;

use stvnrlnd\Press\MarkdownParser;

class Body
{
    public static function process($type, $value)
    {
        return [
            $type => MarkdownParser::parse($value)
        ];
    }
}
