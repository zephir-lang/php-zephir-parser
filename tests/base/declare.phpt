--TEST--
Tests variable declarations
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$types = [
	"int" => "10",
	"uint" => "10",
	"long" => "10",
	"ulong" => "10",
	"char" => "'a'",
	"uchar" => "'a'",
	"double" => "10.00",
	"float" => "10.00",
	"bool" => "true",
	"boolean" => "true",
	"string" => "\"foobar\"",
	"array" => "[10,20,30]",
	"var" => "10"
];

$declarations = "";
foreach ($types as $type=>$value) {
	$declarations .=<<<DEC
	{$type} foo;
	{$type} foo = {$value};

DEC;
}

$code =<<<ZEP
function test() {
{$declarations}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s %s %s %s\n",
		$statement["type"],
		$statement["data-type"],
		$statement["variables"][0]["variable"],
		$statement["variables"][0]["expr"]["type"] ?? "-",
		$statement["variables"][0]["expr"]["value"] ?? "-"
	);
}
?>
--EXPECT--
declare int foo - -
declare int foo int 10
declare uint foo - -
declare uint foo int 10
declare long foo - -
declare long foo int 10
declare ulong foo - -
declare ulong foo int 10
declare char foo - -
declare char foo char a
declare uchar foo - -
declare uchar foo char a
declare double foo - -
declare double foo double 10.00
declare double foo - -
declare double foo double 10.00
declare bool foo - -
declare bool foo bool true
declare bool foo - -
declare bool foo bool true
declare string foo - -
declare string foo string foobar
declare array foo - -
declare array foo array -
declare variable foo - -
declare variable foo int 10
