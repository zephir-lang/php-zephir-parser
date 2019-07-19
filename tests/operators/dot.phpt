--TEST--
Tests dot/concat operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = 1 . 2;
	let a = "foo" . "bar";
	let a = b . a;
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
int 1 concat int 2
string foo concat string bar
variable b concat variable a
