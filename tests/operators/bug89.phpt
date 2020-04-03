--TEST--
Tests bitwise operators priority
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function test () {
    let t = u & v << 7;
}
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));

?>
--EXPECT--
array(1) {
  [0]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(4) "test"
    ["statements"]=>
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
            string(6) "assign"
            ["variable"]=>
            string(1) "t"
            ["expr"]=>
            array(6) {
              ["type"]=>
              string(11) "bitwise_and"
              ["left"]=>
              array(5) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(1) "u"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(2)
                ["char"]=>
                int(15)
              }
              ["right"]=>
              array(6) {
                ["type"]=>
                string(17) "bitwise_shiftleft"
                ["left"]=>
                array(5) {
                  ["type"]=>
                  string(8) "variable"
                  ["value"]=>
                  string(1) "v"
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
                  string(3) "int"
                  ["value"]=>
                  string(1) "7"
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(2)
                  ["char"]=>
                  int(23)
                }
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(2)
                ["char"]=>
                int(23)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(2)
              ["char"]=>
              int(23)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(23)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
