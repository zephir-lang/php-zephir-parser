--TEST--
Tests special operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . "/../utils.inc";
$code =<<<ZEP
function test() {
	if empty arr { }
	if isset arr["item"] { }
	if typeof obj { }
	if clone obj { }
	if fetch dest, arr["item"] { }
	if unlikely false { }
	if likely true { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["expr"];
	unset_keys_recursive($expr, ["char", "line", "file"]);
	echo json_encode($expr) . "\n";
}
?>
--EXPECT--
{"type":"empty","left":{"type":"variable","value":"arr"}}
{"type":"isset","left":{"type":"array-access","left":{"type":"variable","value":"arr"},"right":{"type":"string","value":"item"}}}
{"type":"typeof","left":{"type":"variable","value":"obj"}}
{"type":"clone","left":{"type":"variable","value":"obj"}}
{"type":"fetch","left":{"type":"variable","value":"dest"},"right":{"type":"array-access","left":{"type":"variable","value":"arr"},"right":{"type":"string","value":"item"}}}
{"type":"unlikely","left":{"type":"bool","value":"false"}}
{"type":"likely","left":{"type":"bool","value":"true"}}
