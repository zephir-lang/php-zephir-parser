--TEST--
try-catch control statement with catch variable
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function test() {
	try {
		if true { }
	} catch \Exception, e { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir[0]["statements"][0]);
?>

--EXPECT--
array(6) {
  ["type"]=>
  string(9) "try-catch"
  ["statements"]=>
  array(1) {
    [0]=>
    array(5) {
      ["type"]=>
      string(2) "if"
      ["expr"]=>
      array(5) {
        ["type"]=>
        string(4) "bool"
        ["value"]=>
        string(4) "true"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(11)
      }
      ["file"]=>
      string(11) "(eval code)"
      ["line"]=>
      int(4)
      ["char"]=>
      int(2)
    }
  }
  ["catches"]=>
  array(1) {
    [0]=>
    array(5) {
      ["classes"]=>
      array(1) {
        [0]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(10) "\Exception"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(4)
          ["char"]=>
          int(20)
        }
      }
      ["variable"]=>
      array(5) {
        ["type"]=>
        string(8) "variable"
        ["value"]=>
        string(1) "e"
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
      int(5)
      ["char"]=>
      int(1)
    }
  }
  ["file"]=>
  string(11) "(eval code)"
  ["line"]=>
  int(5)
  ["char"]=>
  int(1)
}
