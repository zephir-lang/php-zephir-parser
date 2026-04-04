--TEST--
Class members (const, property, method) may be interleaved in any order (issue #26)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Bugreport;

class ExampleAction {
	const MY_ACTION_NAME = "MY_ACTION_NAME";

	public function createMyAction(array payload) {
		return payload;
	}

	const MY_OTHER_ACTION_NAME = "MY_OTHER_ACTION_NAME";

	public function createMyOtherAction(array payload) {
		return payload;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$def = $ir[1]["definition"];

echo "constants count: " . count($def["constants"]) . "\n";
echo "const[0] name: " . $def["constants"][0]["name"] . "\n";
echo "const[1] name: " . $def["constants"][1]["name"] . "\n";
echo "methods count: " . count($def["methods"]) . "\n";
echo "method[0] name: " . $def["methods"][0]["name"] . "\n";
echo "method[1] name: " . $def["methods"][1]["name"] . "\n";
?>

--EXPECT--
constants count: 2
const[0] name: MY_ACTION_NAME
const[1] name: MY_OTHER_ACTION_NAME
methods count: 2
method[0] name: createMyAction
method[1] name: createMyOtherAction

