--TEST--
Tests ignoring single line comments
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("comments/sl_comment.zep");
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
    string(%d) "%s/tests/data/comments/sl_comment.zep"
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
          string(%d) "%s/tests/data/comments/sl_comment.zep"
          ["line"]=>
          int(6)
          ["last-line"]=>
          int(9)
          ["char"]=>
          int(16)
        }
      }
      ["file"]=>
      string(%d) "%s/tests/data/comments/sl_comment.zep"
      ["line"]=>
      int(4)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(%d) "%s/tests/data/comments/sl_comment.zep"
    ["line"]=>
    int(4)
    ["char"]=>
    int(5)
  }
}
