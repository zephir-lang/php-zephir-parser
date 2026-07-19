--TEST--
Typed properties inside a trait body (zephir#2608)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// The typed-property rules live on xx_class_property_definition, which is shared
// by class and trait bodies, so a trait must parse typed properties identically.
$code =<<<ZEP
namespace Test;

trait Buffered
{
	protected array items = [];
	public ?string label;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$trait = $ir[1];

echo "type: ", $trait['type'], "\n";

foreach ($trait['definition']['properties'] as $p) {
	$nullable = array_key_exists('nullable', $p) ? 'yes' : 'no';
	echo $p['name'], " | type=", $p['data-type'], " | nullable=", $nullable, "\n";
}
?>
--EXPECT--
type: trait
items | type=array | nullable=no
label | type=string | nullable=yes
