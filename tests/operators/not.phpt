--TEST--
Tests not operator
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = ! foo;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["assignments"][0]["expr"];
	printf("%s %s %s\n",
		$expr["type"],
		$expr["left"]["type"],
		$expr["left"]["value"]
	);
}
?>
--EXPECT--
not variable foo
