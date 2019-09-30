--TEST--
Tests AND operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = true && false;
	let a = a && b;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["assignments"][0]["expr"];
	printf("%s %s %s %s %s\n",
		$expr["left"]["type"],
		$expr["left"]["value"],
		$expr["type"],
		$expr["right"]["type"],
		$expr["right"]["value"]
	);
}
?>
--EXPECT--
bool true and bool false
variable a and variable b
