--TEST--
Tests using globals
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
namespace Example;

class Test
{
    public function all()
    {
        var get1 = _GET;
        var post1 = _POST;
        var request1 = _REQUEST;
        var cookie1 = _COOKIE;
        var server1 = _SERVER;
        var session1 = _SESSION;
        var files1 = _FILES;
        var env1 = _ENV;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

echo count($ir[1]["definition"]["methods"][0]["statements"]) . "\n";

foreach ($ir[1]["definition"]["methods"][0]["statements"] as $statement) {
	printf(
		"%s %s [1/%d]: %s => %s\n",
		$statement["type"],
		$statement["data-type"],
		count($statement["variables"]),
		$statement["variables"][0]["variable"],
		$statement["variables"][0]["expr"]["value"]
	);
}
--EXPECT--
8
declare variable [1/1]: get1 => _GET
declare variable [1/1]: post1 => _POST
declare variable [1/1]: request1 => _REQUEST
declare variable [1/1]: cookie1 => _COOKIE
declare variable [1/1]: server1 => _SERVER
declare variable [1/1]: session1 => _SESSION
declare variable [1/1]: files1 => _FILES
declare variable [1/1]: env1 => _ENV
