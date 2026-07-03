--TEST--
Traits reject modifiers, extends, implements; interfaces reject `use` — syntax errors, as in PHP (zephir#504)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$cases = [
	'final trait'      => "trait X {\n}\nfinal trait Y {\n}",
	'abstract trait'   => "abstract trait Y {\n}",
	'trait extends'    => "trait Y extends Z {\n}",
	'trait implements' => "trait Y implements Z {\n}",
	'use in interface' => "interface I {\n\tuse T;\n}",
];

foreach ($cases as $label => $zep) {
	$ir = zephir_parse_file("namespace Test;\n" . $zep, '(eval code)');
	echo $label . ": " . $ir["type"] . "\n";
}
?>
--EXPECT--
final trait: error
abstract trait: error
trait extends: error
trait implements: error
use in interface: error
