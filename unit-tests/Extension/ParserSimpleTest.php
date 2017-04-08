<?php

namespace Zephir\Parser\Tests;

class ParserSimpleTest extends TestCase
{
    /** @test */
    public function shouldProperlyParseTheFile()
    {
        $path = $this->dataPath('simple/example.zep');
        $expected = [
            [
                'type' => 'namespace',
                'name' => 'Example',
                'file' => $path,
                'line' => 3,
                'char' => 5,
            ],
            [
                'type'     => 'class',
                'name'     => 'Test',
                'abstract' => 0,
                'final'    => 0,
                'definition' => [
                    'properties' => [
                        [
                            'visibility' => ['public'],
                            'type' => 'property',
                            'name' => 'foo',
                            'file' => $path,
                            'line' => 6,
                            'char' => 10,
                        ],
                        [
                            'visibility' => ['protected'],
                            'type' => 'property',
                            'name' => 'bar',
                            'file' => $path,
                            'line' => 7,
                            'char' => 8,
                        ],
                        [
                            'visibility' => ['private'],
                            'type' => 'property',
                            'name' => 'baz',
                            'file' => $path,
                            'line' => 8,
                            'char' => 1,
                        ],
                  ],
                  'file' => $path,
                  'line' => 3,
                  'char' => 5,
                ],
                'file' => $path,
                'line' => 3,
                'char' => 5,
            ],
        ];

        $this->assertSame($expected, $this->parseFile('simple/example.zep'));
    }
}
