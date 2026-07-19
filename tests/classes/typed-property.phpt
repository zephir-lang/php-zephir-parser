--TEST--
Typed class properties: builtin type, nullable, <Class> cast, default, shortcuts (zephir#2608)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class Types
{
	public array items = [];
	protected ?string name;
	private int count = 0;
	public <Response> response;
	public bool flag { get, set };
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$props = $ir[0]['definition']['properties'];

foreach ($props as $p) {
	// A property carries either a builtin `data-type` string or a `<Class>`
	// `cast` node, never both; `nullable` is present only for `?type`.
	$type = array_key_exists('data-type', $p) ? $p['data-type'] : ('<' . $p['cast']['value'] . '>');
	$nullable = array_key_exists('nullable', $p) ? 'yes' : 'no';
	$default = array_key_exists('default', $p) ? $p['default']['type'] : 'none';
	$shortcuts = array_key_exists('shortcuts', $p) ? 'yes' : 'no';
	echo $p['name'], " | type=", $type, " | nullable=", $nullable, " | default=", $default, " | shortcuts=", $shortcuts, "\n";
}
?>
--EXPECT--
items | type=array | nullable=no | default=empty-array | shortcuts=no
name | type=string | nullable=yes | default=none | shortcuts=no
count | type=int | nullable=no | default=int | shortcuts=no
response | type=<Response> | nullable=no | default=none | shortcuts=no
flag | type=bool | nullable=no | default=none | shortcuts=yes
