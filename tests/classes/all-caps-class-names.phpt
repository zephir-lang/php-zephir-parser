--TEST--
All-caps class names in casts, type hints and catch (zephir#2824)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// An all-caps name such as PDO lexes as CONSTANT, and every place a class name
// is written must take it, building the same "variable" node as for Pdo.
$code =<<<ZEP
class User
{
	protected <PDO> held;

	public function param(<PDO> a, <DB> b = null) -> <PDO>
	{
		var e;

		let a = <PDO> b;

		try {
			let a = 1;
		} catch PDO | DB, e {
		}

		return function (<PDO> c) -> <PDO[]> { };
	}

	public function union(<PDO> | <DB> value) -> <PDO> | <DB>
	{
	}
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[0]['definition'];
$method = $class['methods'][0];
$body = $method['statements'];
$closure = $body[3]['expr'];
$union = $class['methods'][1];

$casts = array(
	$class['properties'][0]['cast'],
	$method['parameters'][0]['cast'],
	$method['parameters'][1]['cast'],
	$method['return-type']['list'][0]['cast'],
	$body[1]['assignments'][0]['expr']['left'],
	$body[2]['catches'][0]['classes'][0],
	$body[2]['catches'][0]['classes'][1],
	$closure['left'][0]['cast'],
	$closure['return-type']['list'][0]['cast'],
	$union['parameters'][0]['data-types'][0]['cast'],
	$union['parameters'][0]['data-types'][1]['cast'],
	$union['return-type']['list'][1]['cast'],
);

foreach ($casts as $cast) {
	echo $cast['type'], ' ', $cast['value'], "\n";
}
echo $body[1]['assignments'][0]['expr']['type'], "\n";
echo $closure['return-type']['list'][0]['collection'], "\n";
?>
--EXPECT--
variable PDO
variable PDO
variable DB
variable PDO
variable PDO
variable PDO
variable DB
variable PDO
variable PDO
variable PDO
variable DB
variable DB
type-hint
1
