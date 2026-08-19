<?php

/**
 * Compact prefix rendering of an expression node, for tests that assert the
 * *shape* of a tree rather than every file/line/char field.
 *
 *   sub(int -0x7f, int 1)
 */
function dump_expr(array $node): string
{
    switch ($node['type']) {
        case 'int':
        case 'uint':
        case 'long':
        case 'ulong':
        case 'double':
        case 'string':
        case 'istring':
        case 'char':
        case 'bool':
        case 'constant':
        case 'variable':
            return $node['type'] . ' ' . $node['value'];

        case 'null':
            return 'null';

        case 'empty-array':
            return 'empty-array';

        case 'array':
            $items = [];
            foreach ($node['left'] as $item) {
                $items[] = isset($item['key'])
                    ? dump_expr($item['key']) . ': ' . dump_expr($item['value'])
                    : dump_expr($item['value']);
            }

            return 'array(' . implode(', ', $items) . ')';
    }

    $operands = [];
    foreach (['left', 'right', 'extra'] as $key) {
        if (isset($node[$key]['type'])) {
            $operands[] = dump_expr($node[$key]);
        }
    }

    return $node['type'] . '(' . implode(', ', $operands) . ')';
}
