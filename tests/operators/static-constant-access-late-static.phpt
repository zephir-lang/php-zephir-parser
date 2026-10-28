--TEST--
static::CONSTANT (late static binding) takes the node shape of self::CONSTANT
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	return static::FOO;
	return self::FOO;
	return static::FOO . "x";
	return static::foo();
	return static::class;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]["expr"]);

$describe = function (array $expr) use (&$describe): string {
	switch ($expr["type"]) {
		case "static-constant-access":
			return "const(" . $expr["left"]["value"] . "::" . $expr["right"]["value"] . ")";
		case "scall":
			return "scall(" . $expr["class"] . "::" . $expr["name"] . ")";
		case "string":
			return '"' . $expr["value"] . '"';
		default:
			return $expr["type"] . "(" . $describe($expr["left"]) . ", " . $describe($expr["right"]) . ")";
	}
};
foreach ($ir[0]["statements"] as $statement) {
	echo $describe($statement["expr"]), "\n";
}
?>
--EXPECT--
array(6) {
  ["type"]=>
  string(22) "static-constant-access"
  ["left"]=>
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
    int(20)
  }
  ["right"]=>
  array(5) {
    ["type"]=>
    string(8) "variable"
    ["value"]=>
    string(3) "FOO"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(20)
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(2)
  ["char"]=>
  int(20)
}
const(static::FOO)
const(self::FOO)
concat(const(static::FOO), "x")
scall(static::foo)
const(static::class)
