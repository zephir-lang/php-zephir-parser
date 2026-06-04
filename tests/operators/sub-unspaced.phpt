--TEST--
Subtraction with a "-" glued to a digit after a value (zephir #2011)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = b-1;
	let a = b -1;
	let a = b- 1;
	let a = 5-1;
	let a = arr[0]-1;
	let a = -1;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["assignments"][0]["expr"];
	if ($expr["type"] === "int") {
		printf("int %s\n", $expr["value"]);
	} else {
		printf("%s(%s, %s)\n", $expr["type"], $expr["left"]["type"], $expr["right"]["type"]);
	}
}
?>
--EXPECT--
sub(variable, int)
sub(variable, int)
sub(variable, int)
sub(int, int)
sub(array-access, int)
int -1
--CREDITS--
Zephir Team
