--TEST--
do-while control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	do { } while true;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s %s\n",
		$statement["type"],
		$statement["expr"]["type"],
		$statement["expr"]["value"]
	);
}
?>
--EXPECT--
do-while bool true
