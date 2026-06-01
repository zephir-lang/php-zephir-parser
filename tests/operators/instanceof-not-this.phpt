--TEST--
instanceof precedence: !this instanceof b groups as !(this instanceof b)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
require __DIR__ . '/instanceof_eval.inc';

$code =<<<ZEP
function test() {
	let r = !this instanceof b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["assignments"][0]["expr"];

// Structure: !( this instanceof b )
printf("%s %s %s\n", $e["type"], $e["left"]["type"], $e["left"]["left"]["value"]);

// Behavior: `this` is just a variable; identical to native PHP `!$obj instanceof b`
foreach (['b-instance' => new b(), 'not-b' => new stdClass()] as $label => $obj) {
    $ast = zephir_eval_ast($e, ['this' => $obj]);
    $php = !$obj instanceof b;
    printf("%s php=%s ast=%s %s\n", $label, var_export($php, true), var_export($ast, true), $ast === $php ? 'MATCH' : 'DIFF');
}
?>
--EXPECT--
not instanceof this
b-instance php=false ast=false MATCH
not-b php=true ast=true MATCH
