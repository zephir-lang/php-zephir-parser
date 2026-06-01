<?php

/**
 * Minimal evaluator for the Zephir AST nodes used by the instanceof
 * precedence tests. It lets each test confirm that the grouping produced
 * by the parser yields the SAME boolean result as native PHP.
 *
 * Fixture classes `b` and `d` are the instanceof targets referenced by the
 * test expressions.
 */

class b {}
class d {}

function zephir_eval_ast(array $n, array $env)
{
    switch ($n['type']) {
        case 'variable':  return $env[$n['value']];
        case 'list':      return zephir_eval_ast($n['left'], $env);
        case 'not':       return !zephir_eval_ast($n['left'], $env);
        case 'and':       return zephir_eval_ast($n['left'], $env) && zephir_eval_ast($n['right'], $env);
        case 'or':        return zephir_eval_ast($n['left'], $env) || zephir_eval_ast($n['right'], $env);
        case 'equals':    return zephir_eval_ast($n['left'], $env) == zephir_eval_ast($n['right'], $env);
        case 'identical': return zephir_eval_ast($n['left'], $env) === zephir_eval_ast($n['right'], $env);
        case 'instanceof':
            $class = $n['right']['value'];
            return zephir_eval_ast($n['left'], $env) instanceof $class;
        default:
            throw new RuntimeException('unhandled node: ' . $n['type']);
    }
}
