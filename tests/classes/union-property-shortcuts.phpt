--TEST--
Union-typed class properties with shortcuts and all-caps names (zephir#2761)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// A union-typed property takes the same `{ get, set }` shortcuts and all-caps
// (CONSTANT-token) names as a single-typed one, and produces the same node.
$code =<<<ZEP
class Example
{
	public int|float num = 1 { get, set };

	protected string|<Bar> tag { get };

	/** @var int|null */
	protected int|null note { get, set };

	/** @var string|int */
	protected string|int key = "" { get };

	public int|string LIMIT = 1;

	protected int|null MAX;

	/** @var float */
	public int|float RATE = 2 { get };

	/** @var int */
	public int|string SIZE;

	/** @var int */
	public int|string WIDTH = 3;

	/** @var int */
	public int|string HEIGHT { set };

	public int|string DEPTH { get };
}
ZEP;

$ir    = zephir_parse_file($code, '(eval code)');
$props = $ir[0]['definition']['properties'];

foreach ($props as $p) {
	$members = [];
	foreach ($p['data-types'] as $m) {
		$members[] = array_key_exists('cast', $m) ? ('<' . $m['cast']['value'] . '>') : $m['data-type'];
	}

	$shortcuts = [];
	foreach ($p['shortcuts'] ?? [] as $s) {
		$shortcuts[] = $s['name'];
	}

	echo $p['name'], ' = ', implode('|', $members),
		' | default=', $p['default']['type'] ?? '-',
		' | shortcuts=', $shortcuts ? implode(',', $shortcuts) : '-',
		' | doc=', isset($p['docblock']) ? 'yes' : 'no', "\n";
}
?>
--EXPECT--
num = int|double | default=int | shortcuts=get,set | doc=no
tag = string|<Bar> | default=- | shortcuts=get | doc=no
note = int|null | default=- | shortcuts=get,set | doc=yes
key = string|int | default=string | shortcuts=get | doc=yes
LIMIT = int|string | default=int | shortcuts=- | doc=no
MAX = int|null | default=- | shortcuts=- | doc=no
RATE = int|double | default=int | shortcuts=get | doc=yes
SIZE = int|string | default=- | shortcuts=- | doc=yes
WIDTH = int|string | default=int | shortcuts=- | doc=yes
HEIGHT = int|string | default=- | shortcuts=set | doc=yes
DEPTH = int|string | default=- | shortcuts=get | doc=no
