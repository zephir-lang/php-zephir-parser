--TEST--
Tests recognizing wrapping C-code in CBLOCKs
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
<?php include(__DIR__ . '/../skipifwin32.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Test
{
    public function block()
    {
        %{

            // Some comment

            {
                while(1) {
                    RETURN_MM_NULL();
                }
            }
        }%
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
?>
--EXPECT--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
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
    string(4) "Test"
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
          string(5) "block"
          ["statements"]=>
          array(1) {
            [0]=>
            array(5) {
              ["type"]=>
              string(6) "cblock"
              ["value"]=>
              string(150) "

            // Some comment

            {
                while(1) {
                    RETURN_MM_NULL();
                }
            }
        "
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(17)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(5)
          ["last-line"]=>
          int(18)
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
