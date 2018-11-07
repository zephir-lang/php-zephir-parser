--TEST--
Using imports
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

use Foo;
use Bar;
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));
--EXPECT--
array(3) {
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
    int(3)
  }
  [1]=>
  array(5) {
    ["type"]=>
    string(3) "use"
    ["aliases"]=>
    array(1) {
      [0]=>
      array(4) {
        ["name"]=>
        string(3) "Foo"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(8)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(3)
  }
  [2]=>
  array(5) {
    ["type"]=>
    string(3) "use"
    ["aliases"]=>
    array(1) {
      [0]=>
      array(4) {
        ["name"]=>
        string(3) "Bar"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(4)
        ["char"]=>
        int(8)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(8)
  }
}
