--TEST--
Tests in operator with for loop (no regression)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	for v in arr {
		if v in other {
		}
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$forStmt = $ir[0]["statements"][0];
printf("for: value=%s\n", $forStmt["value"]);

$ifStmt = $forStmt["statements"][0];
printf("if-expr: %s\n", $ifStmt["expr"]["type"]);
printf("if-left: %s=%s\n", $ifStmt["expr"]["left"]["type"], $ifStmt["expr"]["left"]["value"]);
printf("if-right: %s=%s\n", $ifStmt["expr"]["right"]["type"], $ifStmt["expr"]["right"]["value"]);
?>
--EXPECT--
for: value=v
if-expr: in
if-left: variable=v
if-right: variable=other
