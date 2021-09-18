--TEST--
Key => value complex yield statement
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function loop_from_closure() {
    var closure, generator, key, value;

    let closure = function()  {
        var k, v;

        for k, v in ["a", "b", "c", "d"] {
            yield k, v;
        }
    };

    let generator = closure();
    for key, value in generator {
        echo key . "-" . val;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
var_dump($ir);
?>
--EXPECT--
array(1) {
  [0]=>
  array(6) {
    ["type"]=>
    string(8) "function"
    ["name"]=>
    string(17) "loop_from_closure"
    ["statements"]=>
    array(4) {
      [0]=>
      array(6) {
        ["type"]=>
        string(7) "declare"
        ["data-type"]=>
        string(8) "variable"
        ["variables"]=>
        array(4) {
          [0]=>
          array(4) {
            ["variable"]=>
            string(7) "closure"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(16)
          }
          [1]=>
          array(4) {
            ["variable"]=>
            string(9) "generator"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(27)
          }
          [2]=>
          array(4) {
            ["variable"]=>
            string(3) "key"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(32)
          }
          [3]=>
          array(4) {
            ["variable"]=>
            string(5) "value"
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(2)
            ["char"]=>
            int(39)
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
      array(5) {
        ["type"]=>
        string(3) "let"
        ["assignments"]=>
        array(1) {
          [0]=>
          array(7) {
            ["assign-type"]=>
            string(8) "variable"
            ["operator"]=>
            string(6) "assign"
            ["variable"]=>
            string(7) "closure"
            ["expr"]=>
            array(5) {
              ["type"]=>
              string(7) "closure"
              ["right"]=>
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
                      int(5)
                      ["char"]=>
                      int(14)
                    }
                    [1]=>
                    array(4) {
                      ["variable"]=>
                      string(1) "v"
                      ["file"]=>
                      string(11) "(eval code)"
                      ["line"]=>
                      int(5)
                      ["char"]=>
                      int(17)
                    }
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(7)
                  ["char"]=>
                  int(11)
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
                          int(7)
                          ["char"]=>
                          int(23)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(7)
                        ["char"]=>
                        int(23)
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
                          int(7)
                          ["char"]=>
                          int(26)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(7)
                        ["char"]=>
                        int(26)
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
                          int(7)
                          ["char"]=>
                          int(29)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(7)
                        ["char"]=>
                        int(29)
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
                          int(7)
                          ["char"]=>
                          int(32)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(7)
                        ["char"]=>
                        int(32)
                      }
                    }
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(7)
                    ["char"]=>
                    int(34)
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
                        int(8)
                        ["char"]=>
                        int(20)
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
                        int(8)
                        ["char"]=>
                        int(23)
                      }
                      ["file"]=>
                      string(11) "(eval code)"
                      ["line"]=>
                      int(9)
                      ["char"]=>
                      int(9)
                    }
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(10)
                  ["char"]=>
                  int(5)
                }
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(10)
              ["char"]=>
              int(6)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(10)
            ["char"]=>
            int(6)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(12)
        ["char"]=>
        int(7)
      }
      [2]=>
      array(5) {
        ["type"]=>
        string(3) "let"
        ["assignments"]=>
        array(1) {
          [0]=>
          array(7) {
            ["assign-type"]=>
            string(8) "variable"
            ["operator"]=>
            string(6) "assign"
            ["variable"]=>
            string(9) "generator"
            ["expr"]=>
            array(6) {
              ["type"]=>
              string(5) "fcall"
              ["name"]=>
              string(7) "closure"
              ["call-type"]=>
              int(1)
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(12)
              ["char"]=>
              int(30)
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(12)
            ["char"]=>
            int(30)
          }
        }
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(13)
        ["char"]=>
        int(7)
      }
      [3]=>
      array(9) {
        ["type"]=>
        string(3) "for"
        ["expr"]=>
        array(5) {
          ["type"]=>
          string(8) "variable"
          ["value"]=>
          string(9) "generator"
          ["file"]=>
          string(11) "(eval code)"
          ["line"]=>
          int(13)
          ["char"]=>
          int(33)
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
                    int(14)
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
                    int(14)
                    ["char"]=>
                    int(22)
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(14)
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
                  int(14)
                  ["char"]=>
                  int(27)
                }
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(14)
                ["char"]=>
                int(27)
              }
            }
            ["file"]=>
            string(11) "(eval code)"
            ["line"]=>
            int(15)
            ["char"]=>
            int(5)
          }
        }
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
    int(4)
    ["char"]=>
    int(26)
  }
}
