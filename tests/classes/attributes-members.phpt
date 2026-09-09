--TEST--
PHP attributes on class and interface members (zephir#2466)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../attrdump.inc';
// Class members flow through xx_class_member, interface members through the
// separate xx_class_consts_definition / xx_interface_methods_definition rules,
// so both paths need the wrapper. The canonical order is docblock first, then
// attributes; the reverse is tolerated and leaves the docblock in its normal
// inline key position.
$code =<<<ZEP
class Members
{
	#[Marker]
	const PLAIN = 1;

	/**
	 * Doc then attribute.
	 */
	#[Marker("c")]
	const DOCUMENTED = 2;

	const UNMARKED = 3;

	#[Marker]
	public plain = 0;

	#[Marker(1), Other]
	protected readonly int typed;

	#[Marker]
	/**
	 * Attribute then doc.
	 */
	private reversed = 0;

	public unmarked = 0;

	#[Marker]
	public function run()
	{
	}

	/**
	 * Doc then attribute.
	 */
	#[Marker(key: "v")]
	public static function build()
	{
	}

	public function unmarked()
	{
	}
}

interface Contract
{
	#[Marker]
	const LIMIT = 10;

	#[Marker]
	public function handle();

	public function plain();
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

foreach (['constants' => 'const', 'properties' => 'prop', 'methods' => 'method'] as $bucket => $label) {
	foreach ($ir[0]['definition'][$bucket] as $member) {
		echo $label, ' ', $member['name'], ' | ', attr_render($member),
			' | doc=', (array_key_exists('docblock', $member) ? 'yes' : 'no'), "\n";
	}
}

foreach ($ir[1]['definition']['constants'] as $member) {
	echo 'iface-const ', $member['name'], ' | ', attr_render($member), "\n";
}
foreach ($ir[1]['definition']['methods'] as $member) {
	echo 'iface-method ', $member['name'], ' | ', attr_render($member), "\n";
}

// A docblock read BEFORE the attributes is re-attached after the node is built,
// so it lands in the key tail; one read after them keeps its inline position.
$props = $ir[0]['definition']['properties'];
echo 'keys(typed)=', implode(',', array_keys($props[1])), "\n";
echo 'keys(reversed)=', implode(',', array_keys($props[2])), "\n";
echo 'keys(unmarked)=', implode(',', array_keys($props[3])), "\n";
?>
--EXPECT--
const PLAIN | Marker | doc=no
const DOCUMENTED | Marker("c") | doc=yes
const UNMARKED | - | doc=no
prop plain | Marker | doc=no
prop typed | Marker(1) Other | doc=no
prop reversed | Marker | doc=yes
prop unmarked | - | doc=no
method run | Marker | doc=no
method build | Marker(key: "v") | doc=yes
method unmarked | - | doc=no
iface-const LIMIT | Marker
iface-method handle | Marker
iface-method plain | -
keys(typed)=visibility,type,name,data-type,file,line,char,attributes
keys(reversed)=visibility,type,name,default,docblock,file,line,char,attributes
keys(unmarked)=visibility,type,name,default,file,line,char
