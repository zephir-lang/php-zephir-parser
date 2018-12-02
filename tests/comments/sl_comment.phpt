--TEST--
Tests ignoring single line comments
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

 // A comment before class name
class Comment {
    // Some comment
    public function test_me() {
        // Yet another comment
    }
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
    string(7) "Example"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(7) "Comment"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["methods"]=>
      array(1) {
        [0]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(7) "test_me"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(6)
          ["last-line"]=>
          int(9)
          ["char"]=>
          int(19)
        }
      }
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(4)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(4)
    ["char"]=>
    int(5)
  }
}
