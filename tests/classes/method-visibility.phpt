--TEST--
Class Method visibility
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
class MyClass {
	internal function test() { }
	public function test() { }
	protected function test() { }
	private function test() { }
	static function test() { }
	inline function test() { }
	deprecated function test() { }
	abstract function test() { }
	final function test() { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["definition"]["methods"] as $method) {
	printf("%s %s %s\n",
		$method["type"],
		$method["name"],
		implode(",",$method["visibility"])
	);
}
?>
--EXPECT--
method test internal
method test public
method test protected
method test private
method test static
method test inline
method test deprecated
method test abstract
method test final
