--TEST--
Union types on parameters and class properties (zephir#2613)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class Example
{
	public int|float num = 1;
	private int|string|null note;
	public string|<Bar> tag;

	public function squareAndAdd(float|int bar, <Alpha>|<Beta> obj) -> int|float
	{
		return bar;
	}
}
ZEP;

$ir    = zephir_parse_file($code, '(eval code)');
$def   = $ir[0]['definition'];

function members($node) {
	$out = [];
	foreach ($node['data-types'] as $m) {
		$out[] = array_key_exists('cast', $m) ? ('<' . $m['cast']['value'] . '>') : $m['data-type'];
	}
	return implode('|', $out);
}

foreach ($def['properties'] as $p) {
	echo 'prop ', $p['name'], ' = ', members($p), "\n";
}

$params = $def['methods'][0]['parameters'];
foreach ($params as $param) {
	echo 'param ', $param['name'], ' (', $param['data-type'], ') = ', members($param), "\n";
}
?>
--EXPECT--
prop num = int|double
prop note = int|string|null
prop tag = string|<Bar>
param bar (variable) = double|int
param obj (variable) = <Alpha>|<Beta>
