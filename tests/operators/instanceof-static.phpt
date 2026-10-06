--TEST--
instanceof static (late static binding) takes the operand shape of instanceof self
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if a instanceof static { }
	if a instanceof self { }
	if !a instanceof static { }
	if a instanceof static && b { }
	if a instanceof static::class { }
	if a instanceof static::m() { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]["right"]);

$describe = function (array $expr) use (&$describe): string {
	switch ($expr["type"]) {
		case "variable":
			return $expr["value"];
		case "not":
			return "!(" . $describe($expr["left"]) . ")";
		case "static-constant-access":
			return $expr["left"]["value"] . "::" . $expr["right"]["value"];
		case "scall":
			return $expr["class"] . "::" . $expr["name"] . "()";
		default:
			return $expr["type"] . "(" . $describe($expr["left"]) . ", " . $describe($expr["right"]) . ")";
	}
};
foreach ($ir[0]["statements"] as $statement) {
	echo $describe($statement["expr"]), "\n";
}
?>
--EXPECT--
array(5) {
  ["type"]=>
  string(8) "variable"
  ["value"]=>
  string(6) "static"
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(25)
}
instanceof(a, static)
instanceof(a, self)
!(instanceof(a, static))
and(instanceof(a, static), b)
instanceof(a, static::class)
instanceof(a, static::m())
