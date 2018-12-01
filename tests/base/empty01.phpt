--TEST--
Should return an empty array in case of empty file
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php var_dump(zephir_parse_file('', '(eval code)')); ?>
--EXPECT--
array(0) {
}
