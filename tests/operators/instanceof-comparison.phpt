--TEST--
instanceof precedence: binds tighter than equality (a instanceof b == c == (a instanceof b) == c)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
require __DIR__ . '/instanceof_eval.inc';

$code =<<<ZEP
function test() {
	let r = a instanceof b == c;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];

// Structure: ( a instanceof b ) == c
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s\n", $e["right"]["value"]);

// Behavior: identical to native PHP `$a instanceof b == $c`
$cases = [
    'b/true'   => [new b(), true],
    'b/false'  => [new b(), false],
    'obj/true' => [new stdClass(), true],
    'obj/false'=> [new stdClass(), false],
];
foreach ($cases as $label => list($a, $c)) {
    $ast = zephir_eval_ast($e, ['a' => $a, 'c' => $c]);
    $php = $a instanceof b == $c;
    printf("%s php=%s ast=%s %s\n", $label, var_export($php, true), var_export($ast, true), $ast === $php ? 'MATCH' : 'DIFF');
}
?>
--EXPECT--
equals
instanceof
c
b/true php=true ast=true MATCH
b/false php=false ast=false MATCH
obj/true php=false ast=false MATCH
obj/false php=true ast=true MATCH
