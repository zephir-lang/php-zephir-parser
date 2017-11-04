--TEST--
zephir_parse_file() - Tests concat-assign for strings like int
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../../zephir_parser_test.inc");

$ir = parse_file("operators/assignments/concat.zep");

$statements = $ir[1]["definition"]["methods"][0]["statements"];

array_pop($statements);
array_shift($statements);

var_dump($statements);
--EXPECTF--
array(3) {
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
        string(6) "assign"
        ["variable"]=>
        string(1) "a"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(6) "string"
          ["value"]=>
          string(1) "1"
          ["file"]=>
          string(%d) "%s"
          ["line"]=>
          int(8)
          ["char"]=>
          int(14)
        }
        ["file"]=>
        string(%d) "%s"
        ["line"]=>
        int(8)
        ["char"]=>
        int(14)
      }
    }
    ["file"]=>
    string(%d) "%s"
    ["line"]=>
    int(9)
    ["char"]=>
    int(5)
  }
  [1]=>
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
        string(6) "assign"
        ["variable"]=>
        string(1) "b"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(6) "string"
          ["value"]=>
          string(1) "2"
          ["file"]=>
          string(%d) "%s"
          ["line"]=>
          int(9)
          ["char"]=>
          int(14)
        }
        ["file"]=>
        string(%d) "%s"
        ["line"]=>
        int(9)
        ["char"]=>
        int(14)
      }
    }
    ["file"]=>
    string(%d) "%s"
    ["line"]=>
    int(10)
    ["char"]=>
    int(5)
  }
  [2]=>
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
        string(13) "concat-assign"
        ["variable"]=>
        string(1) "b"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(1) "a"
          ["file"]=>
          string(%d) "%s"
          ["line"]=>
          int(10)
          ["char"]=>
          int(12)
        }
        ["file"]=>
        string(%d) "%s"
        ["line"]=>
        int(10)
        ["char"]=>
        int(12)
      }
    }
    ["file"]=>
    string(%d) "%s"
    ["line"]=>
    int(11)
    ["char"]=>
    int(8)
  }
}
