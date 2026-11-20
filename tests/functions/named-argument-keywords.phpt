--TEST--
A named argument may be named by a keyword or an all-caps word (zephir#2824)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// PHP takes any word as an argument name, so `strlen(string: s)` and
// `implode(array: a)` must parse. A keyword token has no text: the name is
// its spelling, which is why a token two spellings share stays an error.
$code =<<<ZEP
function f()
{
	return g(name: 1, string: 2, array: 3, Class: 4, NAME: 5, default: 6, null: 7);
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]['statements'][0]['expr']['parameters'] as $parameter) {
	echo $parameter['name'], '=', $parameter['parameter']['value'], "\n";
}

foreach (array('float', 'double', 'bool', 'boolean', 'fn', 'function') as $name) {
	$ir = zephir_parse_file('function f() { return g(' . $name . ': 1); }', '(eval code)');
	echo $name, ' ', $ir['type'], "\n";
}
?>
--EXPECT--
name=1
string=2
array=3
class=4
NAME=5
default=6
null=7
float error
double error
bool error
boolean error
fn error
function error
