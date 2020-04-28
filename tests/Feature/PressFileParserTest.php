<?php

namespace stvnrlnd\Press\Tests;

use Orchestra\Testbench\TestCase;
use stvnrlnd\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_a_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../Files/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertStringContainsString(
            'title: Post Title',
            $data[1]
        );

        $this->assertStringContainsString(
            'description: Post description.',
            $data[1]
        );

        $this->assertStringContainsString(
            'This is the post body.',
            $data[2]
        );
    }
}
