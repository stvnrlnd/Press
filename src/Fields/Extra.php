<?php

namespace stvnrlnd\Press\Fields;

class Extra extends Field
{
    public static function process($type, $value, $data)
    {
        $extra = isset($data['extra']) ? (array) json_decode($data['extra']) : [];

        return [
            'extra' => json_encode(array_merge($extra, [
                $type => $value
            ]))
        ];
    }
}
