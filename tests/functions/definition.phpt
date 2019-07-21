--TEST--
Function definitions
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test(int a) { }
fn test(int a) { }
function test(int a, int b) -> int | string { }
function test(int a, int b) -> int! { }
function test(int a, int b) -> <App\MyInterface> { }
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir as $func) {
	printf("%s %s %d\n",
		$func["type"],
		$func["name"],
		count($func["parameters"] ?? [])
	);

	if (isset($func["return-type"])) {
		foreach ($func["return-type"]["list"] as $item) {
			printf("%s %s %s %s %s\n",
				$item["type"],
				$item["data-type"] ?? "-",
				$item["mandatory"] ?? "-",
				$item["cast"]["value"] ?? "-",
				$item["collection"] ?? "-"
			);
		}
	}
}
?>
--EXPECT--
function test 1
function test 1
function test 2
return-type-parameter int 0 - -
return-type-parameter string 0 - -
function test 2
return-type-parameter int 1 - -
function test 2
return-type-parameter - - App\MyInterface 0
