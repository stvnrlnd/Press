<?php

namespace stvnrlnd\Press\Fields;

use Carbon\Carbon;

class Date extends Field
{
    public static function process($type, $value, $data)
    {
        return [
            $type => Carbon::parse($value),
        ];
    }
}
