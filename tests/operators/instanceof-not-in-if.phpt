--TEST--
instanceof precedence: !a instanceof b as an if condition groups as !(a instanceof b)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
require __DIR__ . '/instanceof_eval.inc';

$code =<<<ZEP
function test() {
	if !a instanceof b {
		return true;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$e  = $ir[0]["statements"][0]["expr"];

// Structure: !( a instanceof b )
printf("%s\n", $e["type"]);
printf("%s\n", $e["left"]["type"]);
printf("%s %s\n", $e["left"]["left"]["value"], $e["left"]["right"]["value"]);

// Behavior: identical to native PHP `!$a instanceof b`
foreach (['b-instance' => new b(), 'not-b' => new stdClass()] as $label => $a) {
    $ast = zephir_eval_ast($e, ['a' => $a]);
    $php = !$a instanceof b;
    printf("%s php=%s ast=%s %s\n", $label, var_export($php, true), var_export($ast, true), $ast === $php ? 'MATCH' : 'DIFF');
}
?>
--EXPECT--
not
instanceof
a b
b-instance php=false ast=false MATCH
not-b php=true ast=true MATCH
