<?php

namespace stvnrlnd\Press\Fields;

use stvnrlnd\Press\MarkdownParser;

class Body extends Field
{
    public static function process($type, $value, $data)
    {
        return [
            $type => MarkdownParser::parse($value)
        ];
    }
}
