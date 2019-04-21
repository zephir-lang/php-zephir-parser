--TEST--
Using Cyrillic characters in the source code
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Test;

class test {

    public function testUTF8() {
        return "сдфггхх";
    }
}
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));
?>
--EXPECT--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(4) "Test"
    ["file"]=>
    string(11) "(eval code)"
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
    string(4) "test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["methods"]=>
      array(1) {
        [0]=>
        array(8) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(8) "testUTF8"
          ["statements"]=>
          array(1) {
            [0]=>
            array(5) {
              ["type"]=>
              string(6) "return"
              ["expr"]=>
              array(5) {
                ["type"]=>
                string(6) "string"
                ["value"]=>
                string(14) "сдфггхх"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(6)
                ["char"]=>
                int(30)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(7)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(5)
          ["last-line"]=>
          int(8)
          ["char"]=>
          int(19)
        }
      }
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(3)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
}
