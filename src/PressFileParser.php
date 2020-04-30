<?php

namespace stvnrlnd\Press;

use Illuminate\Support\Str;
use stvnrlnd\Press\MarkdownParser;
use Illuminate\Support\Facades\File;

class PressFileParser
{
    protected $filename;

    protected $raw;
    protected $data;

    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->splitFile();
        $this->explodeData();
        $this->processFields();
    }

    public function getRaw()
    {
        return $this->raw;
    }

    public function getData()
    {
        return $this->data;
    }

    protected function splitFile()
    {
        preg_match(
            '/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->raw
        );
    }

    protected function explodeData()
    {
        foreach (explode("\n", trim($this->raw[1])) as $fieldString) {
            preg_match(
                '/(.*):\s?(.*)/',
                $fieldString,
                $fieldArray
            );

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }

        $this->data['body'] = trim($this->raw[2]);
    }

    protected function processFields()
    {
        foreach ($this->data as $field => $value) {
            $class = 'stvnrlnd\\Press\\Fields\\' . Str::title($field);

            if (! class_exists($class)) {
                $class = 'stvnrlnd\\Press\\Fields\\Extra';
            }

            $this->data = array_merge(
                $this->data,
                $class::process($field, $value, $this->data)
            );
        }
    }
}
