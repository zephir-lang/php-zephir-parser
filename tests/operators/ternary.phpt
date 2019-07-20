--TEST--
Tests ternary operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . "/../utils.inc";
$code =<<<ZEP
function test() {
	let b = a == 1 ? "x" : "y";
	let b = a ? true : false;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["assignments"][0]["expr"];
	unset_keys_recursive($expr, ["char", "line", "file"]);
	echo json_encode($expr) . "\n";
}
?>
--EXPECT--
{"type":"ternary","left":{"type":"equals","left":{"type":"variable","value":"a"},"right":{"type":"int","value":"1"}},"right":{"type":"string","value":"x"},"extra":{"type":"string","value":"y"}}
{"type":"ternary","left":{"type":"variable","value":"a"},"right":{"type":"bool","value":"true"},"extra":{"type":"bool","value":"false"}}
