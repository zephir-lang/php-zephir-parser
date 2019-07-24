--TEST--
Interface declaration
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
interface MiddlewareInterfaceEx extends MiddlewareInterface
{
	const HELLO = "world";
	public function handle();
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(7) {
    ["type"]=>
    string(9) "interface"
    ["name"]=>
    string(21) "MiddlewareInterfaceEx"
    ["extends"]=>
    array(1) {
      [0]=>
      array(5) {
        ["type"]=>
        string(8) "variable"
        ["value"]=>
        string(19) "MiddlewareInterface"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(2)
        ["char"]=>
        int(1)
      }
    }
    ["definition"]=>
    array(5) {
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
          string(6) "handle"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(4)
          ["last-line"]=>
          int(5)
          ["char"]=>
          int(16)
        }
      }
      ["constants"]=>
      array(1) {
        [0]=>
        array(6) {
          ["type"]=>
          string(5) "const"
          ["name"]=>
          string(5) "HELLO"
          ["default"]=>
          array(5) {
            ["type"]=>
            string(6) "string"
            ["value"]=>
            string(5) "world"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(3)
            ["char"]=>
            int(21)
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(4)
          ["char"]=>
          int(7)
        }
      }
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(5)
      ["char"]=>
      int(1)
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(0)
    ["char"]=>
    int(0)
  }
}
