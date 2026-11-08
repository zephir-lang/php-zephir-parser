--TEST--
A closure records the line it starts on, the one PHP names it after
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function closures() {
	let a = function () { };
	let b = function (x,
		y) {
		return x;
	};
	let c = function () {
		return function () {
			return 1;
		};
	};
	let d = number =>
		number * 2;
}
ZEP;

function dump(array $node, $depth = 0)
{
	if (in_array($node['type'] ?? null, ['closure', 'closure-arrow'], true)) {
		printf("%s%s start-line=%d line=%d\n", str_repeat('  ', $depth), $node['type'], $node['start-line'], $node['line']);
		$depth++;
	}

	foreach ($node as $child) {
		if (is_array($child)) {
			dump($child, $depth);
		}
	}
}

dump(zephir_parse_file($code, '(eval code)'));
?>
--EXPECT--
closure start-line=2 line=2
closure start-line=3 line=6
closure start-line=7 line=11
  closure start-line=8 line=10
closure-arrow start-line=12 line=13
