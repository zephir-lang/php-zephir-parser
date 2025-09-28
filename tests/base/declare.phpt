--TEST--
Tests variable declarations
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	int foo = 10;
	uint foo = 10;
	long foo = 10;
	ulong foo = 10;
	char foo = 'a';
	uchar foo = 'a';
	double foo = 10.00;
	float foo = 10.00;
	bool foo = true;
	boolean foo = true;
	string foo = "foobar";
	array foo = [10,20,30];
	var foo = 10;
	object obj = new stdClass;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s %s %s %s\n",
		$statement["type"],
		$statement["data-type"],
		$statement["variables"][0]["variable"],
		$statement["variables"][0]["expr"]["type"],
		$statement["variables"][0]["expr"]["value"] ?? "-"
	);
}
?>
--EXPECT--
declare int foo int 10
declare uint foo int 10
declare long foo int 10
declare ulong foo int 10
declare char foo char a
declare uchar foo char a
declare double foo double 10.00
declare double foo double 10.00
declare bool foo bool true
declare bool foo bool true
declare string foo string foobar
declare array foo array -
declare variable foo int 10
declare object obj new -
