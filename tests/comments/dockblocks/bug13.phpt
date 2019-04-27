--TEST--
Tests class like names in the method annotation
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Phpdoc;

class Test
{
    /**
     * @var \stdClass
     */
    protected _foo { get, set };
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

echo $ir[1]["definition"]["properties"][0]["docblock"];
?>
--EXPECT--
**
     * @var \stdClass
     *
