--TEST--
Tests for empty dockblock
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
var_dump(zephir_parse_file("/**/", '(eval code)'));
var_dump(zephir_parse_file("/**/\n\t  \n/**/", '(eval code)'));
?>
--EXPECT--
array(0) {
}
array(0) {
}
