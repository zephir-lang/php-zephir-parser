<?php

/**
 * Renders the `attributes` key of an IR node as a compact one-line string, so a
 * .phpt can assert on attribute names and arguments without pinning the whole
 * IR (which carries file/line/char on every node).
 *
 * Returns "-" when the node carries no `attributes` key at all, which is the
 * shape every attribute-free declaration must keep.
 */
function attr_render(array $node): string
{
    if (!array_key_exists('attributes', $node)) {
        return '-';
    }

    $rendered = [];
    foreach ($node['attributes'] as $attribute) {
        $arguments = [];
        foreach ($attribute['arguments'] ?? [] as $argument) {
            $arguments[] = (array_key_exists('name', $argument) ? $argument['name'] . ': ' : '')
                . attr_render_expr($argument['parameter']);
        }

        $rendered[] = $attribute['name'] . ([] === $arguments ? '' : '(' . implode(', ', $arguments) . ')');
    }

    return implode(' ', $rendered);
}

function attr_render_expr(array $node): string
{
    switch ($node['type']) {
        case 'int':
        case 'double':
        case 'bool':
            return $node['value'];
        case 'null':
            return 'null';
        case 'string':
            return '"' . $node['value'] . '"';
        case 'char':
            return "'" . $node['value'] . "'";
        case 'constant':
        case 'variable':
            return $node['value'];
        case 'static-constant-access':
            return $node['left']['value'] . '::' . $node['right']['value'];
        case 'empty-array':
            return '[]';
        case 'array':
            $items = [];
            foreach ($node['left'] as $item) {
                $items[] = (array_key_exists('key', $item) ? attr_render_expr($item['key']) . ': ' : '')
                    . attr_render_expr($item['value']);
            }

            return '[' . implode(', ', $items) . ']';
    }

    return '<' . $node['type'] . '>';
}
