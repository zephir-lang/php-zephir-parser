--TEST--
Class constant initializer accepts a full expression (zephir #2061)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../dumpexpr.inc';

$code =<<<ZEP
class MyClass
{
	const A = -0x7f - 1;
	const B = 1024 * 8;
	const C = 0xff << 8 | 0x0f;
	const D = "a" . "b";
	const E = self::B + 1;
	const F = (1 + 3) / 2;
	const G = PHP_INT_SIZE == 8 ? 64 : 32;
	const H = ~0;
	const I = !false;
	const J = [1 + 1, 2 * 2];
	const K = 10;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["definition"]["constants"] as $constant) {
	printf("%s = %s\n", $constant["name"], dump_expr($constant["default"]));
}
?>
--EXPECT--
A = sub(int -0x7f, int 1)
B = mul(int 1024, int 8)
C = bitwise_or(bitwise_shiftleft(int 0xff, int 8), int 0x0f)
D = concat(string a, string b)
E = add(static-constant-access(variable self, variable B), int 1)
F = div(list(add(int 1, int 3)), int 2)
G = ternary(equals(constant PHP_INT_SIZE, int 8), int 64, int 32)
H = bitwise_not(int 0)
I = not(bool false)
J = array(add(int 1, int 1), mul(int 2, int 2))
K = int 10
--CREDITS--
Zephir Team
