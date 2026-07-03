--TEST--
Trait body may `use` another trait (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Test;

trait Hello
{
	public function hello() -> string
	{
		return "hello";
	}
}

trait HelloWorld
{
	use Hello;

	public function helloWorld() -> string
	{
		return this->hello() . " world";
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

echo "first type: " . $ir[1]["type"] . ", name: " . $ir[1]["name"] . "\n";
echo "second type: " . $ir[2]["type"] . ", name: " . $ir[2]["name"] . "\n";
$def = $ir[2]["definition"];
echo "uses count: " . count($def["uses"]) . "\n";
echo "uses[0] trait[0]: " . $def["uses"][0]["traits"][0]["value"] . "\n";
echo "methods count: " . count($def["methods"]) . "\n";
?>
--EXPECT--
first type: trait, name: Hello
second type: trait, name: HelloWorld
uses count: 1
uses[0] trait[0]: Hello
methods count: 1
