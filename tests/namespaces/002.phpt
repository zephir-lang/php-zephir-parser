--TEST--
Using imports and aliases
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

use Foo as Baz;
use Bar as Buz;
ZEP;

var_dump(zephir_parse_file($code, '(eval code)'));
?>
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
      array(5) {
        ["name"]=>
        string(3) "Foo"
        ["alias"]=>
        string(3) "Baz"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(15)
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
      array(5) {
        ["name"]=>
        string(3) "Bar"
        ["alias"]=>
        string(3) "Buz"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(4)
        ["char"]=>
        int(15)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(15)
  }
}
