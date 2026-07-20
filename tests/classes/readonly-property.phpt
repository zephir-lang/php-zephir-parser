--TEST--
Readonly modifier on class properties (zephir#2614)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// `readonly` is a visibility/modifier keyword sharing the xx_visibility rule,
// so it may appear anywhere in the modifier list (before or after
// public/protected/private) and combines with every property type prefix:
// builtin, nullable, <Class> cast and union. The parser only records the
// modifier as a `visibility` list entry; the typed / no-default / no-static
// rules are enforced later by the compiler, not here.
$code =<<<ZEP
class Point
{
	public readonly int x;
	readonly protected string label;
	private readonly <Config> config;
	public readonly int|string id;
}
ZEP;

$ir    = zephir_parse_file($code, '(eval code)');
$props = $ir[0]['definition']['properties'];

// A property carries either a single builtin `data-type`, a single `<Class>`
// `cast` node, or an ordered `data-types` list for a union.
function prop_type($p) {
	if (array_key_exists('data-types', $p)) {
		$out = [];
		foreach ($p['data-types'] as $m) {
			$out[] = array_key_exists('cast', $m) ? ('<' . $m['cast']['value'] . '>') : $m['data-type'];
		}
		return implode('|', $out);
	}
	return array_key_exists('cast', $p) ? ('<' . $p['cast']['value'] . '>') : $p['data-type'];
}

foreach ($props as $p) {
	echo $p['name'], ' | ', implode(',', $p['visibility']), ' | ', prop_type($p), "\n";
}
?>
--EXPECT--
x | public,readonly | int
label | readonly,protected | string
config | private,readonly | <Config>
id | public,readonly | int|string
