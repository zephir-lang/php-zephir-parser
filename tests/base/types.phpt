--TEST--
Tests recognizing data types
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Test
{
    public t_int1 =        10;
    public t_int2 =      -100;
    public t_int3 =  0xFFFFFF;
    public t_int4 = -0x000000;

    public t_double1 =    0.000001;
    public t_double1 =   -0.000001;
    public t_double1 =  909.999999;
    public t_double1 = -909.999999;

    public t_char1 = 'a';

    public function someString()
    {
        return "hello";
    }

    public function someIString()
    {
        return ~"hello";
    }
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
    string(4) "Test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(5) {
      ["properties"]=>
      array(9) {
        [0]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(6) "t_int1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(3) "int"
            ["value"]=>
            string(2) "10"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(5)
            ["char"]=>
            int(30)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(6)
          ["char"]=>
          int(10)
        }
        [1]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(6) "t_int2"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(3) "int"
            ["value"]=>
            string(4) "-100"
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
          int(10)
        }
        [2]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(6) "t_int3"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(3) "int"
            ["value"]=>
            string(8) "0xFFFFFF"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(7)
            ["char"]=>
            int(30)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(8)
          ["char"]=>
          int(10)
        }
        [3]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(6) "t_int4"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(3) "int"
            ["value"]=>
            string(9) "-0x000000"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(8)
            ["char"]=>
            int(30)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(10)
          ["char"]=>
          int(10)
        }
        [4]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(9) "t_double1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(6) "double"
            ["value"]=>
            string(8) "0.000001"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(10)
            ["char"]=>
            int(35)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(11)
          ["char"]=>
          int(10)
        }
        [5]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(9) "t_double1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(6) "double"
            ["value"]=>
            string(9) "-0.000001"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(11)
            ["char"]=>
            int(35)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(12)
          ["char"]=>
          int(10)
        }
        [6]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(9) "t_double1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(6) "double"
            ["value"]=>
            string(10) "909.999999"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(12)
            ["char"]=>
            int(35)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(13)
          ["char"]=>
          int(10)
        }
        [7]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(9) "t_double1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(6) "double"
            ["value"]=>
            string(11) "-909.999999"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(13)
            ["char"]=>
            int(35)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(15)
          ["char"]=>
          int(10)
        }
        [8]=>
        array(7) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(8) "property"
          ["name"]=>
          string(7) "t_char1"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(4) "char"
            ["value"]=>
            string(1) "a"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(15)
            ["char"]=>
            int(24)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(17)
          ["char"]=>
          int(10)
        }
      }
      ["methods"]=>
      array(2) {
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
          string(10) "someString"
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
                string(5) "hello"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(19)
                ["char"]=>
                int(21)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(20)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(17)
          ["last-line"]=>
          int(22)
          ["char"]=>
          int(19)
        }
        [1]=>
        array(8) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(11) "someIString"
          ["statements"]=>
          array(1) {
            [0]=>
            array(5) {
              ["type"]=>
              string(6) "return"
              ["expr"]=>
              array(5) {
                ["type"]=>
                string(7) "istring"
                ["value"]=>
                string(5) "hello"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(24)
                ["char"]=>
                int(22)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(25)
              ["char"]=>
              int(5)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(22)
          ["last-line"]=>
          int(26)
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
