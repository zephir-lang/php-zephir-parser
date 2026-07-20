--TEST--
Readonly properties inside a trait body (zephir#2614)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// readonly lives on the shared xx_class_property_definition rule, so a trait
// body records the modifier identically to a class body, including the
// nullable (`?type`) prefix.
$code =<<<ZEP
namespace Test;

trait Identifiable
{
	public readonly int id;
	protected readonly ?string token;
}
ZEP;

$ir    = zephir_parse_file($code, '(eval code)');
$trait = $ir[1];

echo "type: ", $trait['type'], "\n";

foreach ($trait['definition']['properties'] as $p) {
	$nullable = array_key_exists('nullable', $p) ? 'yes' : 'no';
	echo $p['name'], ' | ', implode(',', $p['visibility']), ' | ', $p['data-type'], ' | nullable=', $nullable, "\n";
}
?>
--EXPECT--
type: trait
id | public,readonly | int | nullable=no
token | protected,readonly | string | nullable=yes
