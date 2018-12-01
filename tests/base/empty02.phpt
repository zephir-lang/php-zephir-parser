--TEST--
Should return an empty array in case if all characters are whitespace
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php var_dump(zephir_parse_file("\n\n\t                  \n\n\t \r\n\t", '(eval code)')); ?>
--EXPECT--
array(0) {
}
