--TEST--
Final class can extend and implement
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Acme;

use Psr\Http\Client\ClientExceptionInterface;

final class ServerException extends \RuntimeException implements ClientExceptionInterface
{
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

var_dump($ir);
--EXPECT--
array(3) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(4) "Acme"
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(3)
    ["char"]=>
    int(3)
  }
  [1]=>
  array(5) {
    ["type"]=>
    string(3) "use"
    ["aliases"]=>
    array(1) {
      [0]=>
      array(4) {
        ["name"]=>
        string(40) "Psr\Http\Client\ClientExceptionInterface"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(3)
        ["char"]=>
        int(45)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(5)
  }
  [2]=>
  array(10) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(15) "ServerException"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(1)
    ["extends"]=>
    string(17) "\RuntimeException"
    ["implements"]=>
    array(1) {
      [0]=>
      array(5) {
        ["type"]=>
        string(8) "variable"
        ["value"]=>
        string(24) "ClientExceptionInterface"
        ["file"]=>
        string(11) "(eval code)"
        ["line"]=>
        int(6)
        ["char"]=>
        int(1)
      }
    }
    ["file"]=>
    string(11) "(eval code)"
    ["line"]=>
    int(5)
    ["char"]=>
    int(11)
  }
}
