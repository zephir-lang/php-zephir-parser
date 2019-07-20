--TEST--
try-catch control statement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . "/../utils.inc";
$code =<<<ZEP
function test() {
	try { }

	try {
		let foo = 1;
	} catch \Exception { }

	try {
		let foo = 1;
	} catch \Exception, e { }

	try {
		let foo = 1;
	} catch \CustomException | \ParserException {
	} catch \Exception { }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
unset_keys_recursive($ir, ["char", "line", "file"]);
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(3) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(4) "test"
    ["statements"]=>
    array(4) {
      [0]=>
      array(1) {
        ["type"]=>
        string(9) "try-catch"
      }
      [1]=>
      array(3) {
        ["type"]=>
        string(9) "try-catch"
        ["statements"]=>
        array(1) {
          [0]=>
          array(2) {
            ["type"]=>
            string(3) "let"
            ["assignments"]=>
            array(1) {
              [0]=>
              array(4) {
                ["assign-type"]=>
                string(8) "variable"
                ["operator"]=>
                string(6) "assign"
                ["variable"]=>
                string(3) "foo"
                ["expr"]=>
                array(2) {
                  ["type"]=>
                  string(3) "int"
                  ["value"]=>
                  string(1) "1"
                }
              }
            }
          }
        }
        ["catches"]=>
        array(1) {
          [0]=>
          array(1) {
            ["classes"]=>
            array(1) {
              [0]=>
              array(2) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(10) "\Exception"
              }
            }
          }
        }
      }
      [2]=>
      array(3) {
        ["type"]=>
        string(9) "try-catch"
        ["statements"]=>
        array(1) {
          [0]=>
          array(2) {
            ["type"]=>
            string(3) "let"
            ["assignments"]=>
            array(1) {
              [0]=>
              array(4) {
                ["assign-type"]=>
                string(8) "variable"
                ["operator"]=>
                string(6) "assign"
                ["variable"]=>
                string(3) "foo"
                ["expr"]=>
                array(2) {
                  ["type"]=>
                  string(3) "int"
                  ["value"]=>
                  string(1) "1"
                }
              }
            }
          }
        }
        ["catches"]=>
        array(1) {
          [0]=>
          array(2) {
            ["classes"]=>
            array(1) {
              [0]=>
              array(2) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(10) "\Exception"
              }
            }
            ["variable"]=>
            array(2) {
              ["type"]=>
              string(8) "variable"
              ["value"]=>
              string(1) "e"
            }
          }
        }
      }
      [3]=>
      array(3) {
        ["type"]=>
        string(9) "try-catch"
        ["statements"]=>
        array(1) {
          [0]=>
          array(2) {
            ["type"]=>
            string(3) "let"
            ["assignments"]=>
            array(1) {
              [0]=>
              array(4) {
                ["assign-type"]=>
                string(8) "variable"
                ["operator"]=>
                string(6) "assign"
                ["variable"]=>
                string(3) "foo"
                ["expr"]=>
                array(2) {
                  ["type"]=>
                  string(3) "int"
                  ["value"]=>
                  string(1) "1"
                }
              }
            }
          }
        }
        ["catches"]=>
        array(2) {
          [0]=>
          array(1) {
            ["classes"]=>
            array(2) {
              [0]=>
              array(2) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(16) "\CustomException"
              }
              [1]=>
              array(2) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(16) "\ParserException"
              }
            }
          }
          [1]=>
          array(1) {
            ["classes"]=>
            array(1) {
              [0]=>
              array(2) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(10) "\Exception"
              }
            }
          }
        }
      }
    }
  }
}
