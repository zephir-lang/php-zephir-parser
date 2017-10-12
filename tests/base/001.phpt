--TEST--
zephir_parse_file() - Tests class variables
--SKIPIF--
<?php require(__DIR__ . "/../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("base/class_variables.zep");

echo count($ir[1]["definition"]["properties"]) . "\n";

foreach ($ir[1]["definition"]["properties"] as $property) {
  printf("[1/%d] %s %s %s\n", count($property["visibility"]), $property["visibility"][0], $property["type"],  $property["name"]);
}
--EXPECT--
3
[1/1] public property foo
[1/1] protected property bar
[1/1] private property baz
