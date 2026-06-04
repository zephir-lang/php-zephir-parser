--TEST--
Arithmetic operators with operands glued to digits, no spaces (zephir #2011)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let a = b+1;
	let a = b-1;
	let a = b*1;
	let a = b/1;
	let a = b%1;
	let a = 1+2;
	let a = 5-1;
	let a = arr[0]*1;
	let a = b*-1;
	let a = b+-1;
	let a = b/-2;
	let a = b%-1;
}
ZEP;

function describe(array $e): string
{
	if ($e["type"] === "int") {
		return "int(" . $e["value"] . ")";
	}
	return sprintf("%s(%s, %s)", $e["type"], $e["left"]["type"], describe($e["right"]));
}

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	echo describe($statement["assignments"][0]["expr"]), "\n";
}
?>
--EXPECT--
add(variable, int(1))
sub(variable, int(1))
mul(variable, int(1))
div(variable, int(1))
mod(variable, int(1))
add(int, int(2))
sub(int, int(1))
mul(array-access, int(1))
mul(variable, int(-1))
add(variable, int(-1))
div(variable, int(-2))
mod(variable, int(-1))
--CREDITS--
Zephir Team
