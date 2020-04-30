<?php

namespace stvnrlnd\Press\Fields;

abstract class Field
{
    public static function process($fieldType, $fieldValue, $data)
    {
        return [
            $fieldType => $fieldValue
        ];
    }
}
