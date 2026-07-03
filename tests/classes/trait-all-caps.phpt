--TEST--
Trait declaration with an all-caps name (CONSTANT token) (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Test;

trait CSV
{
	public function parse() -> int
	{
		return 1;
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$trait = $ir[1];

echo "type: " . $trait["type"] . "\n";
echo "name: " . $trait["name"] . "\n";
echo "methods count: " . count($trait["definition"]["methods"]) . "\n";

$code =<<<ZEP
namespace Test;

trait Empty1
{
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$trait = $ir[1];

echo "type: " . $trait["type"] . "\n";
echo "name: " . $trait["name"] . "\n";
echo "definition set: " . var_export(isset($trait["definition"]), true) . "\n";
?>
--EXPECT--
type: trait
name: CSV
methods count: 1
type: trait
name: Empty1
definition set: false
