--TEST--
All-caps method names should be accepted (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class MyClass {
	public function TRANSFORM() { }
	public function GET() -> int { return 0; }
}
ZEP;
$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]['definition']['methods'] as $method) {
	printf("%s %s %s\n",
		$method['type'],
		$method['name'],
		implode(',', $method['visibility'])
	);
}
?>
--EXPECT--
method TRANSFORM public
method GET public

