--TEST--
Tests negation operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . "/../utils.inc";
$code =<<<ZEP
function test() {
	let a = -1;
	let a = -a;
	let a = -a - b;
	let a = a - -b;
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
{"type":"int","value":"-1"}
{"type":"minus","left":{"type":"variable","value":"a"}}
{"type":"sub","left":{"type":"minus","left":{"type":"variable","value":"a"}},"right":{"type":"variable","value":"b"}}
{"type":"sub","left":{"type":"variable","value":"a"},"right":{"type":"minus","left":{"type":"variable","value":"b"}}}
