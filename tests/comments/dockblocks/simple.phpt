--TEST--
Tests simple PHP dockblock
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

/**
 * DocBlockFail
 *
 * @author Paul Scarrone <team@phalcon.io>
 */
class DocBlockTest {
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

echo $ir[1]["value"];
?>
--EXPECT--
**
 * DocBlockFail
 *
 * @author Paul Scarrone <team@phalcon.io>
 *
