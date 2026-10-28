--TEST--
CONSTANT::{m}() takes a method name from a variable, as o::{m}() does (zephir#2723)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	MYCLASS::{name}();
	MYCLASS::{name}(1, x);
	return MYCLASS::{name}();
	return MYCLASS::{name}(1, x);
	return MYCLASS::{"name"}();
	return MyClass::{name}();
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["expr"];
	echo $statement["type"], ": ", $expr["type"],
		" dynamic-class=", $expr["dynamic-class"],
		" class=", $expr["class"],
		" dynamic=", $expr["dynamic"],
		" name=", $expr["name"],
		" parameters=", isset($expr["parameters"]) ? count($expr["parameters"]) : 0,
		"\n";
}

var_dump($ir[0]["statements"][2]["expr"]);
?>
--EXPECT--
scall: scall dynamic-class=0 class=MYCLASS dynamic=1 name=name parameters=0
scall: scall dynamic-class=0 class=MYCLASS dynamic=1 name=name parameters=2
return: scall dynamic-class=0 class=MYCLASS dynamic=1 name=name parameters=0
return: scall dynamic-class=0 class=MYCLASS dynamic=1 name=name parameters=2
return: scall dynamic-class=0 class=MYCLASS dynamic=2 name=name parameters=0
return: scall dynamic-class=0 class=MyClass dynamic=1 name=name parameters=0
array(8) {
  ["type"]=>
  string(5) "scall"
  ["dynamic-class"]=>
  int(0)
  ["class"]=>
  string(7) "MYCLASS"
  ["dynamic"]=>
  int(1)
  ["name"]=>
  string(4) "name"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(4)
  ["char"]=>
  int(26)
}
