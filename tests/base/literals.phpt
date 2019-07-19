--TEST--
Tests literal values
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = null;
	let a = NULL;

	let a = true;
	let a = TRUE;

	let a = false;
	let a = FALSE;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s\n",
		$statement["assignments"][0]["expr"]["type"],
		$statement["assignments"][0]["expr"]["value"] ?? "-"
	);
}
?>
--EXPECT--
null -
null -
bool true
bool true
bool false
bool false
