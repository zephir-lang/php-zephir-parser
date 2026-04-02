--TEST--
Tests in and not-in expression operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if x in [1, 2, 3] { }
	if x ! in [1, 2, 3] { }
	if a in b { }
	if a ! in b { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	if ($statement["type"] === "if") {
		printf("%s\n", $statement["expr"]["type"]);
	}
}
?>
--EXPECT--
in
not-in
in
not-in

