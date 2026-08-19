--TEST--
Class property default accepts a full expression (zephir #2061)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../dumpexpr.inc';

$code =<<<ZEP
class MyClass
{
	public size = 1024 * 8;
	protected mask = 0xff << 8 { get };
	public int total = 2 + 3;
	public path = "a" . "/b";
	public plain = 10;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["definition"]["properties"] as $property) {
	printf("%s = %s\n", $property["name"], dump_expr($property["default"]));
}
?>
--EXPECT--
size = mul(int 1024, int 8)
mask = bitwise_shiftleft(int 0xff, int 8)
total = add(int 2, int 3)
path = concat(string a, string /b)
plain = int 10
--CREDITS--
Zephir Team
