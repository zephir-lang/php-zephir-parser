--TEST--
Test extension info
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

function contains($input, $expected) {
    return strpos($input, $expected) !== false
        ? $expected
        : 'not contains';
}

$version = phpversion('Zephir Parser');
$actual = trim(file_get_contents(__DIR__ . '/../../VERSION'));

$compare = $version === $actual;
var_dump($compare);

ob_start();
phpinfo(INFO_MODULES);
$info = trim(ob_get_clean());

echo contains($info, 'Zephir Parser').PHP_EOL;
echo contains($info, 'The Zephir Parser delivered as a C extension for the PHP language.').PHP_EOL;
echo contains($info, 'Zephir Parser => enabled').PHP_EOL;
echo contains($info, 'Author => Zephir Team and contributors').PHP_EOL;
echo contains($info, 'Version =>').PHP_EOL;
echo contains($info, 'Build Date =>').PHP_EOL;
?>
--EXPECT--
bool(true)
Zephir Parser
The Zephir Parser delivered as a C extension for the PHP language.
Zephir Parser => enabled
Author => Zephir Team and contributors
Version =>
Build Date =>
