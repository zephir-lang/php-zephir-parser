--TEST--
The while without parentheses
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Acme;

function test() {
  while result { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
--EXPECT--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(4) "Acme"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(8)
  }
  [1]=>
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
        string(5) "while"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(6) "result"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(4)
          ["char"]=>
          int(16)
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(5)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(8)
  }
}
