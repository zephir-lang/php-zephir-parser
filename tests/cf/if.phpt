--TEST--
IF control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if true { }

	if true {
		let a = 1;
	} else {
		let a = 2;
	}

	if true {
		let a = 1;
	} elseif false {
		let a = 2;
	} elseif true {
		let a = 3;
	} else {
		let a = 4;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	printf("%s %s %s %d %d %d\n",
		$statement["type"],
		$statement["expr"]["type"],
		$statement["expr"]["value"],
		count($statement["statements"] ?? []),
		count($statement["elseif_statements"] ?? []),
		count($statement["else_statements"] ?? [])
	);

	if (isset($statement["elseif_statements"])) {
		foreach ($statement["elseif_statements"] as $elif) {
			printf("elseif %s %s %s %d\n",
				$elif["type"],
				$elif["expr"]["type"],
				$elif["expr"]["value"],
				count($elif["statements"] ?? [])
			);
		}
	}
}
?>
--EXPECT--
if bool true 0 0 0
if bool true 1 0 1
if bool true 1 2 1
elseif if bool false 1
elseif if bool true 1
