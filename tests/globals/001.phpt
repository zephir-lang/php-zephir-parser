--TEST--
zephir_parse_file() - Tests using globals
--SKIPIF--
<?php require(__DIR__ . "/../zephir_parser_skip.inc"); ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("globals/variables.zep");

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
