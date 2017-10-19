--TEST--
zephir_parse_file() - ######## MOD
--SKIPIF--
<?php require(__DIR__ . "/../../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../../zephir_parser_test.inc");

$ir = parse_file("operators/assignments/mod.zep");
$statements = $ir[1]["definition"]["methods"][0]["statements"];

array_pop($statements);
var_dump($statements);
--EXPECTF--
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(3) "let"
    ["assignments"]=>
    array(1) {
      [0]=>
      array(7) {
        ["assign-type"]=>
        string(8) "variable"
        ["operator"]=>
        string(10) "mod-assign"
        ["variable"]=>
        string(7) "degrees"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(3) "360"
          ["file"]=>
          string(%d) "%s"
          ["line"]=>
          int(7)
          ["char"]=>
          int(20)
        }
        ["file"]=>
        string(%d) "%s"
        ["line"]=>
        int(7)
        ["char"]=>
        int(20)
      }
    }
    ["file"]=>
    string(%d) "%s"
    ["line"]=>
    int(8)
    ["char"]=>
    int(8)
  }
}
