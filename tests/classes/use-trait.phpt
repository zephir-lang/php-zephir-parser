--TEST--
Class body `use` of traits: single, comma list, repeated statements, namespaced, all-caps (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Test;

class Foo
{
	use A;
	use B, Ns\Deep\C, CSV;

	public function m() -> int
	{
		return 1;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$def = $ir[1]["definition"];

echo "definition keys: " . implode(",", array_keys($def)) . "\n";
echo "uses count: " . count($def["uses"]) . "\n";
echo "uses[0] type: " . $def["uses"][0]["type"] . "\n";
echo "uses[0] traits count: " . count($def["uses"][0]["traits"]) . "\n";
echo "uses[0] trait[0]: " . $def["uses"][0]["traits"][0]["type"] . "=" . $def["uses"][0]["traits"][0]["value"] . "\n";
echo "uses[1] traits count: " . count($def["uses"][1]["traits"]) . "\n";
echo "uses[1] trait[0]: " . $def["uses"][1]["traits"][0]["value"] . "\n";
echo "uses[1] trait[1]: " . $def["uses"][1]["traits"][1]["value"] . "\n";
echo "uses[1] trait[2]: " . $def["uses"][1]["traits"][2]["value"] . "\n";
echo "methods count: " . count($def["methods"]) . "\n";
?>
--EXPECT--
definition keys: methods,uses,file,line,char
uses count: 2
uses[0] type: use-trait
uses[0] traits count: 1
uses[0] trait[0]: variable=A
uses[1] traits count: 3
uses[1] trait[0]: B
uses[1] trait[1]: Ns\Deep\C
uses[1] trait[2]: CSV
methods count: 1
