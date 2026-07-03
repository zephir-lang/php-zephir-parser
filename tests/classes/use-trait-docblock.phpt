--TEST--
Docblock preceding a class-body trait `use` is attached to the use-trait node (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Test;

class Foo
{
	/**
	 * Adds counting behavior.
	 */
	use Counter;

	public function m() -> int
	{
		return 1;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$def = $ir[1]["definition"];

echo "uses count: " . count($def["uses"]) . "\n";
echo "uses[0] type: " . $def["uses"][0]["type"] . "\n";
echo "uses[0] trait[0]: " . $def["uses"][0]["traits"][0]["value"] . "\n";
echo "has docblock: " . var_export(array_key_exists("docblock", $def["uses"][0]), true) . "\n";
echo "docblock mentions counting: " . var_export(strpos($def["uses"][0]["docblock"], "counting behavior") !== false, true) . "\n";
?>
--EXPECT--
uses count: 1
uses[0] type: use-trait
uses[0] trait[0]: Counter
has docblock: true
docblock mentions counting: true
