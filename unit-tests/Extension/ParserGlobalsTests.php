<?php

namespace Zephir\Parser\Tests;

class ParserGlobalsTest extends TestCase
{
    /** @test */
    public function shouldProperlyParseGlobals()
    {
        $this->assertSame(expected('globals/simple.php'), $this->parseFile('globals/simple.zep'));
    }
}
