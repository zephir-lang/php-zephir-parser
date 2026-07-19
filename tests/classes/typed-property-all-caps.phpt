--TEST--
Typed class properties with all-caps (CONSTANT-token) names (zephir#2608)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// All-caps names lex as CONSTANT rather than IDENTIFIER, so the typed-property
// grammar has a dedicated set of CONSTANT rules that must produce the same node.
$code =<<<ZEP
class Registry
{
	public array BUFFER = [];
	protected ?int LIMIT;
	public string NAME = "x";
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$props = $ir[0]['definition']['properties'];

foreach ($props as $p) {
	$nullable = array_key_exists('nullable', $p) ? 'yes' : 'no';
	echo $p['name'], " | type=", $p['data-type'], " | nullable=", $nullable, "\n";
}
?>
--EXPECT--
BUFFER | type=array | nullable=no
LIMIT | type=int | nullable=yes
NAME | type=string | nullable=no
