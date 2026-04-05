--TEST--
Issue #23: bitwise NOT (~) before function call and combined with binary operators
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function test() {
    let a = ~umask();
    let b = 0666 & ~umask();
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
    array(2) {
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
              string(11) "bitwise_not"
              ["left"]=>
              array(6) {
                ["type"]=>
                string(5) "fcall"
                ["name"]=>
                string(5) "umask"
                ["call-type"]=>
                int(1)
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(2)
                ["char"]=>
                int(21)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(2)
              ["char"]=>
              int(21)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(21)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(7)
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
            array(6) {
              ["type"]=>
              string(11) "bitwise_and"
              ["left"]=>
              array(5) {
                ["type"]=>
                string(3) "int"
                ["value"]=>
                string(4) "0666"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(3)
                ["char"]=>
                int(18)
              }
              ["right"]=>
              array(5) {
                ["type"]=>
                string(11) "bitwise_not"
                ["left"]=>
                array(6) {
                  ["type"]=>
                  string(5) "fcall"
                  ["name"]=>
                  string(5) "umask"
                  ["call-type"]=>
                  int(1)
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(3)
                  ["char"]=>
                  int(28)
                }
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(3)
                ["char"]=>
                int(28)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(3)
              ["char"]=>
              int(28)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(3)
            ["char"]=>
            int(28)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(4)
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

