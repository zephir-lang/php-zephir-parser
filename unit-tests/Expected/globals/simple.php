<?php

return [
    [
        'type' => 'namespace',
        'name' => 'Example',
        'file' => data_path('globals/simple.zep'),
        'line' => 3,
        'char' => 5,
    ],
    [
        'type' => 'class',
        'name' => 'Test',
        'abstract' => 0,
        'final' => 0,
        'definition' => [
                'methods' => [
                        [
                            'visibility' => ['public'],
                            'type' => 'method',
                            'name' => 'all',
                            'statements' => [
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_get',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_GET',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 7,
                                                            'char' => 18,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 7,
                                                    'char' => 18,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 8,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_post',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_POST',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 8,
                                                            'char' => 20,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 8,
                                                    'char' => 20,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 9,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_request',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_REQUEST',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 9,
                                                            'char' => 26,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 9,
                                                    'char' => 26,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 10,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_cookie',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_COOKIE',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 10,
                                                            'char' => 24,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 10,
                                                    'char' => 24,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 11,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_server',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_SERVER',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 11,
                                                            'char' => 24,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 11,
                                                    'char' => 24,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 12,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_session',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_SESSION',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 12,
                                                            'char' => 26,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 12,
                                                    'char' => 26,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 13,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_files',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_FILES',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 13,
                                                            'char' => 22,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 13,
                                                    'char' => 22,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 14,
                                        'char' => 5,
                                    ],
                                    [
                                        'type' => 'declare',
                                        'data-type' => 'variable',
                                        'variables' => [
                                                [
                                                    'variable' => '_env',
                                                    'expr' => [
                                                            'type' => 'variable',
                                                            'value' => '_ENV',
                                                            'file' => data_path('globals/simple.zep'),
                                                            'line' => 14,
                                                            'char' => 18,
                                                        ],
                                                    'file' => data_path('globals/simple.zep'),
                                                    'line' => 14,
                                                    'char' => 18,
                                                ],
                                            ],
                                        'file' => data_path('globals/simple.zep'),
                                        'line' => 15,
                                        'char' => 2,
                                    ],
                                ],
                            'file' => data_path('globals/simple.zep'),
                            'line' => 5,
                            'last-line' => 16,
                            'char' => 16,
                        ],
                    ],
                'file' => data_path('globals/simple.zep'),
                'line' => 3,
                'char' => 5,
            ],
        'file' => data_path('globals/simple.zep'),
        'line' => 3,
        'char' => 5,
    ],
];
