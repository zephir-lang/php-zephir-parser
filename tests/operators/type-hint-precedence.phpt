--TEST--
A type hint binds like a comparison operator (zephir#2824)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// `<A> expr` takes the precedence of its closing GREATER: operators binding
// tighter stay in the hinted operand, looser ones take the hint as theirs.
$code =<<<ZEP
function test() {
	if <Foo> a == b { }
	if <Foo> a && b { }
	if <Foo> a . b { }
	if <Foo> a + b { }
	if <FOO> a instanceof B { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s\n", $statement["expr"]["type"]);
}
?>
--EXPECT--
equals
and
type-hint
type-hint
type-hint
