--TEST--
Loop control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	let n = 40;

	loop { }

	loop {
		let n -= 2;
		if n % 5 == 0 { break; }
		echo x, "\n";
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	if($statement["type"] != "loop") {
		continue;
	}

	printf("%s %s\n",
		$statement["type"],
		count($statement["statements"] ?? [])
	);
}
?>
--EXPECT--
loop 0
loop 3
