--TEST--
Trait declaration with property, constant, instance/static/abstract methods (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
namespace Test;

trait Greeter
{
	protected greeting = "hello";

	const STEP = 2;

	public function greet(string name) -> string
	{
		return this->greeting . " " . name;
	}

	public static function shout() -> string
	{
		return "HI";
	}

	abstract public function label() -> string;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$trait = $ir[1];

echo "type: " . $trait["type"] . "\n";
echo "name: " . $trait["name"] . "\n";
echo "has abstract key: " . var_export(array_key_exists("abstract", $trait), true) . "\n";
echo "has final key: " . var_export(array_key_exists("final", $trait), true) . "\n";
echo "has extends key: " . var_export(array_key_exists("extends", $trait), true) . "\n";
echo "has implements key: " . var_export(array_key_exists("implements", $trait), true) . "\n";

$def = $trait["definition"];
echo "definition keys: " . implode(",", array_keys($def)) . "\n";
echo "properties count: " . count($def["properties"]) . "\n";
echo "property[0] name: " . $def["properties"][0]["name"] . "\n";
echo "constants count: " . count($def["constants"]) . "\n";
echo "const[0] name: " . $def["constants"][0]["name"] . "\n";
echo "methods count: " . count($def["methods"]) . "\n";
echo "method[0] name: " . $def["methods"][0]["name"] . "\n";
echo "method[1] name: " . $def["methods"][1]["name"] . "\n";
echo "method[1] static: " . var_export(in_array("static", $def["methods"][1]["visibility"]), true) . "\n";
echo "method[2] name: " . $def["methods"][2]["name"] . "\n";
echo "method[2] abstract: " . var_export(in_array("abstract", $def["methods"][2]["visibility"]), true) . "\n";
?>
--EXPECT--
type: trait
name: Greeter
has abstract key: false
has final key: false
has extends key: false
has implements key: false
definition keys: properties,methods,constants,file,line,char
properties count: 1
property[0] name: greeting
constants count: 1
const[0] name: STEP
methods count: 3
method[0] name: greet
method[1] name: shout
method[1] static: true
method[2] name: label
method[2] abstract: true
