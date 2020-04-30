<?php

namespace stvnrlnd\Press\Tests;

use stvnrlnd\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    /** @test */
    public function a_first_level_heading_can_be_parsed()
    {
        $text = 'Heading 1';

        $this->assertEquals(
            MarkdownParser::parse("# {$text}"), 
            "<h1>{$text}</h1>"
        );
    }
}
