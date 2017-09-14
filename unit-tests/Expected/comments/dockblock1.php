<?php

return [
    [
        'type' => 'namespace',
        'name' => 'Example',
        'file' => data_path('comments/dockblock1.zep'),
        'line' => 7,
        'char' => 2,
    ],
    [
        'type'  => 'comment',
        'value' => '**
 * DocBlockFail
 *
 * @author Paul Scarrone <paul@phalconphp.com>
 *',
        'file'  => data_path('comments/dockblock1.zep'),
        'line'  => 9,
        'char'  => 5,
    ],
    [
        'type'     => 'class',
        'name'     => 'DocBlockTest',
        'abstract' => 0,
        'final'    => 0,
        'file'     => data_path('comments/dockblock1.zep'),
        'line'     => 9,
        'char'     => 5,
    ],
];
