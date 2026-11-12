--TEST--
The ::class magic constant as a parameter default and in an array default
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test(a = self::class, b = parent::class, c = MyClass::class, d = \Foo\Bar::class, e = RBF::class, array f = [MyClass::class]) {
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["parameters"] as $parameter) {
	$default = $parameter["default"];
	if ("array" === $default["type"]) {
		$default = $default["left"][0]["value"];
	}

	printf(
		"%s = %s | %s:%s -> %s\n",
		$parameter["name"],
		$default["type"],
		$default["left"]["type"],
		$default["left"]["value"],
		$default["right"]["value"]
	);
}

$ir = zephir_parse_file('function test(array a = [self::A: 1, MyClass::class: 2, RBF::B: 3, PHP_EOL: 4, "s": 5]) { }', '(eval code)');
foreach ($ir[0]["parameters"][0]["default"]["left"] as $item) {
	$key = $item["key"];
	printf(
		"key %s %s\n",
		$key["type"],
		"static-constant-access" === $key["type"] ? $key["left"]["value"] . "::" . $key["right"]["value"] : $key["value"]
	);
}

$ir = zephir_parse_file('function test(a = static::class) { }', '(eval code)');
echo $ir["type"], ": ", $ir["message"], "\n";
?>
--EXPECT--
a = static-constant-access | variable:self -> class
b = static-constant-access | variable:parent -> class
c = static-constant-access | variable:MyClass -> class
d = static-constant-access | variable:\Foo\Bar -> class
e = static-constant-access | variable:RBF -> class
f = static-constant-access | variable:MyClass -> class
key static-constant-access self::A
key static-constant-access MyClass::class
key static-constant-access RBF::B
key constant PHP_EOL
key string s
error: Syntax error
