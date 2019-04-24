--TEST--
Tests a complex closure with "use"
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Closure
{
    public function callback(resource fp, filter)
    {
        var line, debug = [];
        let line = fgets(fp);

        let line = preg_replace_callback(
            "|<p>\s*\w|",
            function (matches) use ( & debug, const filter ) {
                let debug += [matches];

                if (matches[0] !== filter) {
                    return strtolower(matches[0]);
                }

                return matches[0];
            },
            line
        );

        return line;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
?>
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
    int(3)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(7) "Closure"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["methods"]=>
      array(1) {
        [0]=>
        array(9) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(8) "callback"
          ["parameters"]=>
          array(2) {
            [0]=>
            array(9) {
              ["type"]=>
              string(9) "parameter"
              ["name"]=>
              string(2) "fp"
              ["const"]=>
              int(0)
              ["data-type"]=>
              string(8) "resource"
              ["mandatory"]=>
              int(0)
              ["reference"]=>
              int(0)
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(5)
              ["char"]=>
              int(41)
            }
            [1]=>
            array(9) {
              ["type"]=>
              string(9) "parameter"
              ["name"]=>
              string(6) "filter"
              ["const"]=>
              int(0)
              ["data-type"]=>
              string(8) "variable"
              ["mandatory"]=>
              int(0)
              ["reference"]=>
              int(0)
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(5)
              ["char"]=>
              int(49)
            }
          }
          ["statements"]=>
          array(4) {
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
                  string(4) "line"
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(7)
                  ["char"]=>
                  int(17)
                }
                [1]=>
                array(5) {
                  ["variable"]=>
                  string(5) "debug"
                  ["expr"]=>
                  array(4) {
                    ["type"]=>
                    string(11) "empty-array"
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
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(8)
              ["char"]=>
              int(11)
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
                  string(4) "line"
                  ["expr"]=>
                  array(7) {
                    ["type"]=>
                    string(5) "fcall"
                    ["name"]=>
                    string(5) "fgets"
                    ["call-type"]=>
                    int(1)
                    ["parameters"]=>
                    array(1) {
                      [0]=>
                      array(4) {
                        ["parameter"]=>
                        array(5) {
                          ["type"]=>
                          string(8) "variable"
                          ["value"]=>
                          string(2) "fp"
                          ["file"]=>
                          string(11) "(eval code)"
                          ["line"]=>
                          int(8)
                          ["char"]=>
                          int(28)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(8)
                        ["char"]=>
                        int(28)
                      }
                    }
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(8)
                    ["char"]=>
                    int(29)
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(8)
                  ["char"]=>
                  int(29)
                }
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(10)
              ["char"]=>
              int(11)
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
                  string(4) "line"
                  ["expr"]=>
                  array(7) {
                    ["type"]=>
                    string(5) "fcall"
                    ["name"]=>
                    string(21) "preg_replace_callback"
                    ["call-type"]=>
                    int(1)
                    ["parameters"]=>
                    array(3) {
                      [0]=>
                      array(4) {
                        ["parameter"]=>
                        array(5) {
                          ["type"]=>
                          string(6) "string"
                          ["value"]=>
                          string(10) "|<p>\s*\w|"
                          ["file"]=>
                          string(11) "(eval code)"
                          ["line"]=>
                          int(11)
                          ["char"]=>
                          int(23)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(11)
                        ["char"]=>
                        int(23)
                      }
                      [1]=>
                      array(4) {
                        ["parameter"]=>
                        array(7) {
                          ["type"]=>
                          string(7) "closure"
                          ["left"]=>
                          array(1) {
                            [0]=>
                            array(9) {
                              ["type"]=>
                              string(9) "parameter"
                              ["name"]=>
                              string(7) "matches"
                              ["const"]=>
                              int(0)
                              ["data-type"]=>
                              string(8) "variable"
                              ["mandatory"]=>
                              int(0)
                              ["reference"]=>
                              int(0)
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(12)
                              ["char"]=>
                              int(30)
                            }
                          }
                          ["right"]=>
                          array(3) {
                            [0]=>
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
                                  string(10) "add-assign"
                                  ["variable"]=>
                                  string(5) "debug"
                                  ["expr"]=>
                                  array(5) {
                                    ["type"]=>
                                    string(5) "array"
                                    ["left"]=>
                                    array(1) {
                                      [0]=>
                                      array(4) {
                                        ["value"]=>
                                        array(5) {
                                          ["type"]=>
                                          string(8) "variable"
                                          ["value"]=>
                                          string(7) "matches"
                                          ["file"]=>
                                          string(11) "(eval code)"
                                          ["line"]=>
                                          int(13)
                                          ["char"]=>
                                          int(37)
                                        }
                                        ["file"]=>
                                        string(11) "(eval code)"
                                        ["line"]=>
                                        int(13)
                                        ["char"]=>
                                        int(37)
                                      }
                                    }
                                    ["file"]=>
                                    string(11) "(eval code)"
                                    ["line"]=>
                                    int(13)
                                    ["char"]=>
                                    int(38)
                                  }
                                  ["file"]=>
                                  string(11) "(eval code)"
                                  ["line"]=>
                                  int(13)
                                  ["char"]=>
                                  int(38)
                                }
                              }
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(15)
                              ["char"]=>
                              int(18)
                            }
                            [1]=>
                            array(6) {
                              ["type"]=>
                              string(2) "if"
                              ["expr"]=>
                              array(5) {
                                ["type"]=>
                                string(4) "list"
                                ["left"]=>
                                array(6) {
                                  ["type"]=>
                                  string(13) "not-identical"
                                  ["left"]=>
                                  array(6) {
                                    ["type"]=>
                                    string(12) "array-access"
                                    ["left"]=>
                                    array(5) {
                                      ["type"]=>
                                      string(8) "variable"
                                      ["value"]=>
                                      string(7) "matches"
                                      ["file"]=>
                                      string(11) "(eval code)"
                                      ["line"]=>
                                      int(15)
                                      ["char"]=>
                                      int(28)
                                    }
                                    ["right"]=>
                                    array(5) {
                                      ["type"]=>
                                      string(3) "int"
                                      ["value"]=>
                                      string(1) "0"
                                      ["file"]=>
                                      string(11) "(eval code)"
                                      ["line"]=>
                                      int(15)
                                      ["char"]=>
                                      int(30)
                                    }
                                    ["file"]=>
                                    string(11) "(eval code)"
                                    ["line"]=>
                                    int(15)
                                    ["char"]=>
                                    int(34)
                                  }
                                  ["right"]=>
                                  array(5) {
                                    ["type"]=>
                                    string(8) "variable"
                                    ["value"]=>
                                    string(6) "filter"
                                    ["file"]=>
                                    string(11) "(eval code)"
                                    ["line"]=>
                                    int(15)
                                    ["char"]=>
                                    int(42)
                                  }
                                  ["file"]=>
                                  string(11) "(eval code)"
                                  ["line"]=>
                                  int(15)
                                  ["char"]=>
                                  int(42)
                                }
                                ["file"]=>
                                string(11) "(eval code)"
                                ["line"]=>
                                int(15)
                                ["char"]=>
                                int(44)
                              }
                              ["statements"]=>
                              array(1) {
                                [0]=>
                                array(5) {
                                  ["type"]=>
                                  string(6) "return"
                                  ["expr"]=>
                                  array(7) {
                                    ["type"]=>
                                    string(5) "fcall"
                                    ["name"]=>
                                    string(10) "strtolower"
                                    ["call-type"]=>
                                    int(1)
                                    ["parameters"]=>
                                    array(1) {
                                      [0]=>
                                      array(4) {
                                        ["parameter"]=>
                                        array(6) {
                                          ["type"]=>
                                          string(12) "array-access"
                                          ["left"]=>
                                          array(5) {
                                            ["type"]=>
                                            string(8) "variable"
                                            ["value"]=>
                                            string(7) "matches"
                                            ["file"]=>
                                            string(11) "(eval code)"
                                            ["line"]=>
                                            int(16)
                                            ["char"]=>
                                            int(46)
                                          }
                                          ["right"]=>
                                          array(5) {
                                            ["type"]=>
                                            string(3) "int"
                                            ["value"]=>
                                            string(1) "0"
                                            ["file"]=>
                                            string(11) "(eval code)"
                                            ["line"]=>
                                            int(16)
                                            ["char"]=>
                                            int(48)
                                          }
                                          ["file"]=>
                                          string(11) "(eval code)"
                                          ["line"]=>
                                          int(16)
                                          ["char"]=>
                                          int(49)
                                        }
                                        ["file"]=>
                                        string(11) "(eval code)"
                                        ["line"]=>
                                        int(16)
                                        ["char"]=>
                                        int(49)
                                      }
                                    }
                                    ["file"]=>
                                    string(11) "(eval code)"
                                    ["line"]=>
                                    int(16)
                                    ["char"]=>
                                    int(50)
                                  }
                                  ["file"]=>
                                  string(11) "(eval code)"
                                  ["line"]=>
                                  int(17)
                                  ["char"]=>
                                  int(17)
                                }
                              }
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(19)
                              ["char"]=>
                              int(22)
                            }
                            [2]=>
                            array(5) {
                              ["type"]=>
                              string(6) "return"
                              ["expr"]=>
                              array(6) {
                                ["type"]=>
                                string(12) "array-access"
                                ["left"]=>
                                array(5) {
                                  ["type"]=>
                                  string(8) "variable"
                                  ["value"]=>
                                  string(7) "matches"
                                  ["file"]=>
                                  string(11) "(eval code)"
                                  ["line"]=>
                                  int(19)
                                  ["char"]=>
                                  int(31)
                                }
                                ["right"]=>
                                array(5) {
                                  ["type"]=>
                                  string(3) "int"
                                  ["value"]=>
                                  string(1) "0"
                                  ["file"]=>
                                  string(11) "(eval code)"
                                  ["line"]=>
                                  int(19)
                                  ["char"]=>
                                  int(33)
                                }
                                ["file"]=>
                                string(11) "(eval code)"
                                ["line"]=>
                                int(19)
                                ["char"]=>
                                int(34)
                              }
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(20)
                              ["char"]=>
                              int(13)
                            }
                          }
                          ["use"]=>
                          array(2) {
                            [0]=>
                            array(9) {
                              ["type"]=>
                              string(9) "parameter"
                              ["name"]=>
                              string(5) "debug"
                              ["const"]=>
                              int(0)
                              ["data-type"]=>
                              string(8) "variable"
                              ["mandatory"]=>
                              int(0)
                              ["reference"]=>
                              int(1)
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(12)
                              ["char"]=>
                              int(45)
                            }
                            [1]=>
                            array(9) {
                              ["type"]=>
                              string(9) "parameter"
                              ["name"]=>
                              string(6) "filter"
                              ["const"]=>
                              int(1)
                              ["data-type"]=>
                              string(8) "variable"
                              ["mandatory"]=>
                              int(0)
                              ["reference"]=>
                              int(0)
                              ["file"]=>
                              string(11) "(eval code)"
                              ["line"]=>
                              int(12)
                              ["char"]=>
                              int(60)
                            }
                          }
                          ["file"]=>
                          string(11) "(eval code)"
                          ["line"]=>
                          int(20)
                          ["char"]=>
                          int(14)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(20)
                        ["char"]=>
                        int(14)
                      }
                      [2]=>
                      array(4) {
                        ["parameter"]=>
                        array(5) {
                          ["type"]=>
                          string(8) "variable"
                          ["value"]=>
                          string(4) "line"
                          ["file"]=>
                          string(11) "(eval code)"
                          ["line"]=>
                          int(22)
                          ["char"]=>
                          int(9)
                        }
                        ["file"]=>
                        string(11) "(eval code)"
                        ["line"]=>
                        int(22)
                        ["char"]=>
                        int(9)
                      }
                    }
                    ["file"]=>
                    string(11) "(eval code)"
                    ["line"]=>
                    int(22)
                    ["char"]=>
                    int(10)
                  }
                  ["file"]=>
                  string(11) "(eval code)"
                  ["line"]=>
                  int(22)
                  ["char"]=>
                  int(10)
                }
              }
              ["file"]=>
              string(11) "(eval code)"
              ["line"]=>
              int(24)
              ["char"]=>
              int(14)
            }
            [3]=>
            array(5) {
              ["type"]=>
              string(6) "return"
              ["expr"]=>
              array(5) {
                ["type"]=>
                string(8) "variable"
                ["value"]=>
                string(4) "line"
                ["file"]=>
                string(11) "(eval code)"
                ["line"]=>
                int(24)
                ["char"]=>
                int(20)
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
          int(12)
          ["last-line"]=>
          int(26)
          ["char"]=>
          int(20)
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
