--TEST--
Tests exclusive range operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = 1 ... 10;
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
int 1 erange int 10
