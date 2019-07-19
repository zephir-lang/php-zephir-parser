--TEST--
Tests for empty dockblock
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
var_dump(zephir_parse_file("/***/", '(eval code)'));
var_dump(zephir_parse_file("/** */", '(eval code)'));
var_dump(zephir_parse_file("/** */\n/***/", '(eval code)'));
var_dump(zephir_parse_file("/**\n*/", '(eval code)'));
var_dump(zephir_parse_file("/**//**\n*/", '(eval code)'));
var_dump(zephir_parse_file("/*\n**//***/", '(eval code)'));
?>
--EXPECT--
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(3) "***"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(1)
  }
}
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(4) "** *"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(1)
    ["char"]=>
    int(4)
  }
}
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(4) "** *"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(0)
  }
  [1]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(3) "***"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(0)
  }
}
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(4) "**
*"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(1)
  }
}
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(4) "**
*"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(1)
  }
}
array(1) {
  [0]=>
  array(5) {
    ["type"]=>
    string(7) "comment"
    ["value"]=>
    string(3) "***"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(2)
    ["char"]=>
    int(2)
  }
}
