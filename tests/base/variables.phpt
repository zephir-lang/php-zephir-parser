--TEST--
Tests using identifiers for variables
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Foo\Bar\Bas
{
    public foo;
    protected bar;
    private baz;

    public \$aaa;
    public \bbb;
    public _ccc;

    public \$_abc;
    public \_cde;
    public __edc;
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
--EXPECTF--
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
    string(11) "Foo\Bar\Bas"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["properties"]=>
      array(9) {
        [0]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "foo"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(6)
          ["char"]=>
          int(13)
        }
        [1]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(9) "protected"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "bar"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(7)
          ["char"]=>
          int(11)
        }
        [2]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(7) "private"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "baz"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(9)
          ["char"]=>
          int(10)
        }
        [3]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(3) "aaa"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(10)
          ["char"]=>
          int(10)
        }
        [4]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "\bbb"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(11)
          ["char"]=>
          int(10)
        }
        [5]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "_ccc"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(13)
          ["char"]=>
          int(10)
        }
        [6]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(4) "_abc"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(14)
          ["char"]=>
          int(10)
        }
        [7]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(5) "\_cde"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(15)
          ["char"]=>
          int(10)
        }
        [8]=>
        array(6) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(5) "__edc"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(16)
          ["char"]=>
          int(1)
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
