<?php

return [
    [
        'type' => 'namespace',
        'name' => 'Example',
        'file' => data_path('simple/example.zep'),
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
                    'file' => data_path('simple/example.zep'),
                    'line' => 6,
                    'char' => 10,
                ],
                [
                    'visibility' => ['protected'],
                    'type' => 'property',
                    'name' => 'bar',
                    'file' => data_path('simple/example.zep'),
                    'line' => 7,
                    'char' => 8,
                ],
                [
                    'visibility' => ['private'],
                    'type' => 'property',
                    'name' => 'baz',
                    'file' => data_path('simple/example.zep'),
                    'line' => 8,
                    'char' => 1,
                ],
          ],
          'file' => data_path('simple/example.zep'),
          'line' => 3,
          'char' => 5,
        ],
        'file' => data_path('simple/example.zep'),
        'line' => 3,
        'char' => 5,
    ],
];
