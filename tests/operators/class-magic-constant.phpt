--TEST--
The ::class magic constant (self, parent, static and class name)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	if self::class { }
	if parent::class { }
	if MyClass::class { }
	if static::class { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["statements"] as $statement) {
	$expr = $statement["expr"];
	printf(
		"%s | %s:%s -> %s\n",
		$expr["type"],
		$expr["left"]["type"],
		$expr["left"]["value"],
		$expr["right"]["value"]
	);
}
?>
--EXPECT--
static-constant-access | variable:self -> class
static-constant-access | variable:parent -> class
static-constant-access | variable:MyClass -> class
static-constant-access | variable:static -> class
