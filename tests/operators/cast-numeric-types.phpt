--TEST--
Cast to numeric types (int, uint, char, uchar, long, ulong)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$types = ['char', 'uchar', 'int', 'uint', 'long', 'ulong'];
foreach ($types as $type) {
	$code = "function test() { return ({$type}) foo; }";
	$ir = zephir_parse_file($code, '(eval code)');
	$expr = $ir[0]["statements"][0]["expr"];
	printf("%-6s => type=%s left=%s\n", $type, $expr["type"], $expr["left"]);
}
?>
--EXPECT--
char   => type=cast left=char
uchar  => type=cast left=uchar
int    => type=cast left=int
uint   => type=cast left=uint
long   => type=cast left=long
ulong  => type=cast left=ulong

