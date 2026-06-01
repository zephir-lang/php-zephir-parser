--TEST--
instanceof precedence: explicit parens !(a instanceof b) still group correctly
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
require __DIR__ . '/instanceof_eval.inc';

$code =<<<ZEP
function test() {
	let r = !(a instanceof b);
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];

// Structure: !( ( a instanceof b ) )
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s\n", $e["left"]["left"]["type"]);
printf("%s %s\n", $e["left"]["left"]["left"]["value"], $e["left"]["left"]["right"]["value"]);

// Behavior: identical to native PHP `!($a instanceof b)`
foreach (['b-instance' => new b(), 'not-b' => new stdClass()] as $label => $a) {
    $ast = zephir_eval_ast($e, ['a' => $a]);
    $php = !($a instanceof b);
    printf("%s php=%s ast=%s %s\n", $label, var_export($php, true), var_export($ast, true), $ast === $php ? 'MATCH' : 'DIFF');
}
?>
--EXPECT--
not
list
instanceof
a b
b-instance php=false ast=false MATCH
not-b php=true ast=true MATCH
