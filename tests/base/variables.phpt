--TEST--
Tests using identifiers for variables
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("base/variables.zep");
var_dump($ir);
--EXPECTF--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
    ["file"]=>
    string(%d) "%s/tests/data/base/variables.zep"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(11) "Foo\Bar\Bas"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["properties"]=>
      array(9) {
        [0]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "foo"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(6)
          ["char"]=>
          int(10)
        }
        [1]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(9) "protected"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "bar"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(7)
          ["char"]=>
          int(8)
        }
        [2]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(7) "private"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "baz"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(9)
          ["char"]=>
          int(7)
        }
        [3]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "aaa"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(10)
          ["char"]=>
          int(7)
        }
        [4]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "\bbb"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(11)
          ["char"]=>
          int(7)
        }
        [5]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "_ccc"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(13)
          ["char"]=>
          int(7)
        }
        [6]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "_abc"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(14)
          ["char"]=>
          int(7)
        }
        [7]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(5) "\_cde"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(15)
          ["char"]=>
          int(7)
        }
        [8]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(5) "__edc"
          ["file"]=>
          string(%d) "%s/tests/data/base/variables.zep"
          ["line"]=>
          int(16)
          ["char"]=>
          int(1)
        }
      }
      ["file"]=>
      string(%d) "%s/tests/data/base/variables.zep"
      ["line"]=>
      int(3)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(%d) "%s/tests/data/base/variables.zep"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
}
