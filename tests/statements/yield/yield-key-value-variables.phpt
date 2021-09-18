--TEST--
Key => value complex yield statement
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function generate() {
    var k, v;

    for k, v in ["a", "b", "c", "d"] {
        yield k, v;
    }
}

function loop_generator() {
    var key, value;

    for key, value in generate() {
        echo key . "-" . val;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(2) {
  [0]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(8) "generate"
    ["statements"]=>
    array(2) {
      [0]=>
      array(6) {
        ["type"]=>
        string(7) "declare"
        ["data-type"]=>
        string(8) "variable"
        ["variables"]=>
        array(2) {
          [0]=>
          array(4) {
            ["variable"]=>
            string(1) "k"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(10)
          }
          [1]=>
          array(4) {
            ["variable"]=>
            string(1) "v"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(13)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(4)
        ["char"]=>
        int(7)
      }
      [1]=>
      array(9) {
        ["type"]=>
        string(3) "for"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(5) "array"
          ["left"]=>
          array(4) {
            [0]=>
            array(4) {
              ["value"]=>
              array(5) {
                ["type"]=>
                string(6) "string"
                ["value"]=>
                string(1) "a"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(4)
                ["char"]=>
                int(19)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(4)
              ["char"]=>
              int(19)
            }
            [1]=>
            array(4) {
              ["value"]=>
              array(5) {
                ["type"]=>
                string(6) "string"
                ["value"]=>
                string(1) "b"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(4)
                ["char"]=>
                int(22)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(4)
              ["char"]=>
              int(22)
            }
            [2]=>
            array(4) {
              ["value"]=>
              array(5) {
                ["type"]=>
                string(6) "string"
                ["value"]=>
                string(1) "c"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(4)
                ["char"]=>
                int(25)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(4)
              ["char"]=>
              int(25)
            }
            [3]=>
            array(4) {
              ["value"]=>
              array(5) {
                ["type"]=>
                string(6) "string"
                ["value"]=>
                string(1) "d"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(4)
                ["char"]=>
                int(28)
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(4)
              ["char"]=>
              int(28)
            }
          }
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(4)
          ["char"]=>
          int(30)
        }
        ["key"]=>
        string(1) "k"
        ["value"]=>
        string(1) "v"
        ["reverse"]=>
        int(0)
        ["statements"]=>
        array(1) {
          [0]=>
          array(6) {
            ["type"]=>
            string(5) "yield"
            ["key"]=>
            array(5) {
              ["type"]=>
              string(8) "variable"
              ["value"]=>
              string(1) "k"
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(5)
              ["char"]=>
              int(16)
            }
            ["value"]=>
            array(5) {
              ["type"]=>
              string(8) "variable"
              ["value"]=>
              string(1) "v"
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(5)
              ["char"]=>
              int(19)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(6)
            ["char"]=>
            int(5)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(7)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(9)
    ["char"]=>
    int(8)
  }
  [1]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(14) "loop_generator"
    ["statements"]=>
    array(2) {
      [0]=>
      array(6) {
        ["type"]=>
        string(7) "declare"
        ["data-type"]=>
        string(8) "variable"
        ["variables"]=>
        array(2) {
          [0]=>
          array(4) {
            ["variable"]=>
            string(3) "key"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(10)
            ["char"]=>
            int(12)
          }
          [1]=>
          array(4) {
            ["variable"]=>
            string(5) "value"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(10)
            ["char"]=>
            int(19)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(12)
        ["char"]=>
        int(7)
      }
      [1]=>
      array(9) {
        ["type"]=>
        string(3) "for"
        ["expr"]=>
        array(6) {
          ["type"]=>
          string(5) "fcall"
          ["name"]=>
          string(8) "generate"
          ["call-type"]=>
          int(1)
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(12)
          ["char"]=>
          int(34)
        }
        ["key"]=>
        string(3) "key"
        ["value"]=>
        string(5) "value"
        ["reverse"]=>
        int(0)
        ["statements"]=>
        array(1) {
          [0]=>
          array(5) {
            ["type"]=>
            string(4) "echo"
            ["expressions"]=>
            array(1) {
              [0]=>
              array(6) {
                ["type"]=>
                string(6) "concat"
                ["left"]=>
                array(6) {
                  ["type"]=>
                  string(6) "concat"
                  ["left"]=>
                  array(5) {
                    ["type"]=>
                    string(8) "variable"
                    ["value"]=>
                    string(3) "key"
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(13)
                    ["char"]=>
                    int(18)
                  }
                  ["right"]=>
                  array(5) {
                    ["type"]=>
                    string(6) "string"
                    ["value"]=>
                    string(1) "-"
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(13)
                    ["char"]=>
                    int(22)
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(13)
                  ["char"]=>
                  int(22)
                }
                ["right"]=>
                array(5) {
                  ["type"]=>
                  string(8) "variable"
                  ["value"]=>
                  string(3) "val"
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(13)
                  ["char"]=>
                  int(27)
                }
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(13)
                ["char"]=>
                int(27)
              }
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(14)
            ["char"]=>
            int(5)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(15)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(9)
    ["char"]=>
    int(8)
  }
}
