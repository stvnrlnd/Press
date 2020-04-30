<?php

namespace stvnrlnd\Press\Tests;

use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use stvnrlnd\Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_a_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../Files/MarkFile1.md'));

        $data = $pressFileParser->getRaw();

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

    /** @test */
    public function a_string_can_also_be_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: Post Title\n---\nThis is the post body."));

        $data = $pressFileParser->getRaw();

        $this->assertStringContainsString(
            'title: Post Title',
            $data[1]
        );

        $this->assertStringContainsString(
            'This is the post body.',
            $data[2]
        );
    }

    /** @test */
    public function each_head_field_gets_separated()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../Files/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals(
            'Post Title',
            $data['title']
        );

        $this->assertEquals(
            'Post description.',
            $data['description']
        );
    }

    /** @test */
    public function the_body_gets_saved_and_trimmed()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../Files/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals(
            "<h1>Heading 1</h1>\n<p>This is the post body.</p>",
            $data['body']
        );
    }

    /** @test */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: April 29, 2020\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(
            Carbon::class,
            $data['date']
        );

        $this->assertEquals(
            '04/29/2020',
            $data['date']->format('m/d/Y')
        );
    }

    /** @test */
    public function an_extra_field_gets_saved()
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(
            json_encode(['author' => 'John Doe']),
            $data['extra']
        );
    }

    /** @test */
    public function multiple_extra_fields_are_saved()
    {
        $pressFileParser = (new PressFileParser("---\nauthor: John Doe\nimage:some/image.jpg\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(
            json_encode([
                'author' => 'John Doe',
                'image' => 'some/image.jpg'
            ]),
            $data['extra']
        );
    }
}
