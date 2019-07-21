--TEST--
Function definition with cast
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() -> <App\MyInterface> { }
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(4) "test"
    ["return-type"]=>
    array(6) {
      ["type"]=>
      string(11) "return-type"
      ["list"]=>
      array(1) {
        [0]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["cast"]=>
          array(5) {
            ["type"]=>
            string(8) "variable"
            ["value"]=>
            string(15) "App\MyInterface"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(1)
            ["char"]=>
            int(39)
          }
          ["collection"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(39)
        }
      }
      ["void"]=>
      int(0)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(1)
      ["char"]=>
      int(39)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(9)
  }
}
