<?php

namespace Zephir\Parser\Tests;

class ParserSimpleTest extends TestCase
{
    /** @test */
    public function shouldProperlyParseTheFile()
    {
        $this->assertSame(expected('simple/example.php'), $this->parseFile('simple/example.zep'));
    }
}
