--TEST--
Switch control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	var a;

	switch 3 {
	case 1:
	case 2:
		let a = "foobar";
		break;
	case 3:
		let a = "baz";
		break;
	default:
		let a = "biz";
		break;
	}

	switch foobar {
	case "hello":
	case hello:
	case HELLO:
	default:
		break;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	if($statement["type"] != "switch") {
		continue;
	}

	printf("%s %s %s\n",
		$statement["type"],
		$statement["expr"]["type"],
		$statement["expr"]["value"]
	);

	foreach ($statement["clauses"] as $clause) {
		printf("%s %s %s %s\n",
			$clause["type"],
			$clause["expr"]["type"] ?? "-",
			$clause["expr"]["value"] ?? "-",
			count($clause["statements"] ?? [])
		);
	}
}
?>
--EXPECT--
switch int 3
case int 1 0
case int 2 2
case int 3 2
default - - 2
switch variable foobar
case string hello 0
case variable hello 0
case constant HELLO 0
default - - 1
