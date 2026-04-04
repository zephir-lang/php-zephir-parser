--TEST--
Non-consecutive const declarations in a class body should not throw a parse error (issue #26)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Bugreport;

class ConstOrder {
	const MY_FIRST_CONST = "test";

	private myProperty;

	const MY_SECOND_CONST = "test2";
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$def = $ir[1]["definition"];

echo "constants count: " . count($def["constants"]) . "\n";
echo "const[0] name: " . $def["constants"][0]["name"] . "\n";
echo "const[1] name: " . $def["constants"][1]["name"] . "\n";
echo "properties count: " . count($def["properties"]) . "\n";
echo "property[0] name: " . $def["properties"][0]["name"] . "\n";
?>

--EXPECT--
constants count: 2
const[0] name: MY_FIRST_CONST
const[1] name: MY_SECOND_CONST
properties count: 1
property[0] name: myProperty

