--TEST--
Function definition with `false` return type
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function singleReturn() -> false { return false; }

function unionReturn() -> int | false { return 1; }
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(2) {
  [0]=>
  array(7) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(12) "singleReturn"
    ["statements"]=>
    array(1) {
      [0]=>
      array(5) {
        ["type"]=>
        string(6) "return"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(4) "bool"
          ["value"]=>
          string(5) "false"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(49)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(1)
        ["char"]=>
        int(51)
      }
    }
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
          ["data-type"]=>
          string(5) "false"
          ["mandatory"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(1)
          ["char"]=>
          int(35)
        }
      }
      ["void"]=>
      int(0)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(1)
      ["char"]=>
      int(35)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(8)
  }
  [1]=>
  array(7) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(11) "unionReturn"
    ["statements"]=>
    array(1) {
      [0]=>
      array(5) {
        ["type"]=>
        string(6) "return"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(3) "int"
          ["value"]=>
          string(1) "1"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(3)
          ["char"]=>
          int(49)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(51)
      }
    }
    ["return-type"]=>
    array(6) {
      ["type"]=>
      string(11) "return-type"
      ["list"]=>
      array(2) {
        [0]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["data-type"]=>
          string(3) "int"
          ["mandatory"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(3)
          ["char"]=>
          int(31)
        }
        [1]=>
        array(6) {
          ["type"]=>
          string(21) "return-type-parameter"
          ["data-type"]=>
          string(5) "false"
          ["mandatory"]=>
          int(0)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(3)
          ["char"]=>
          int(39)
        }
      }
      ["void"]=>
      int(0)
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(3)
      ["char"]=>
      int(39)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(8)
  }
}
