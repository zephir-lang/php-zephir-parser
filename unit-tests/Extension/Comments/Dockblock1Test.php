<?php

namespace Zephir\Parser\Tests\Comments;

use Zephir\Parser\Tests\TestCase;

class Dockblock1Test extends TestCase
{
    /** @test */
    public function shouldProperlyParseDockblock()
    {
        $this->assertEquals($this->parseFile('comments/dockblock1.zep'), expected('comments/dockblock1.php'));
    }
}
