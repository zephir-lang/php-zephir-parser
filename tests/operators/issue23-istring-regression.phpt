--TEST--
Issue #23: ISTRING (~"...") still scanned correctly after bitwise-NOT fix
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function test() {
    let a = ~"hello";
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
            string(1) "a"
            ["expr"]=>
            array(5) {
              ["type"]=>
              string(7) "istring"
              ["value"]=>
              string(5) "hello"
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(2)
              ["char"]=>
              int(19)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(19)
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

