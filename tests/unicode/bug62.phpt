--TEST--
Using Chinese characters in the source code
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Utils;

class Greeting
{

    public static function say()
    {
        echo "中文";
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
    string(5) "Utils"
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
    string(8) "Greeting"
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
          array(2) {
            [0]=>
            string(6) "public"
            [1]=>
            string(6) "static"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(3) "say"
          ["statements"]=>
          array(1) {
            [0]=>
            array(5) {
              ["type"]=>
              string(4) "echo"
              ["expressions"]=>
              array(1) {
                [0]=>
                array(5) {
                  ["type"]=>
                  string(6) "string"
                  ["value"]=>
                  string(6) "中文"
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(8)
                  ["char"]=>
                  int(20)
                }
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(9)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(6)
          ["last-line"]=>
          int(11)
          ["char"]=>
          int(26)
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
