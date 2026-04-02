--TEST--
Nested property access with method call (this->a->method())
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class Caller
{
    public child;

    public function invoke()
    {
        this->child->doSomething();
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[1];
$methods = $class['definition']['methods'];
$invoke = null;
foreach ($methods as $m) {
    if ($m['name'] === 'invoke') { $invoke = $m; break; }
}
if (!$invoke) { echo "MISSING_METHOD\n"; return; }

$statements = $invoke['statements'];
$mcall = null;
foreach ($statements as $st) {
    if ($st['type'] === 'mcall') { $mcall = $st; break; }
}
if (!$mcall) { echo "MISSING_MCALL\n"; return; }

// The expr should be an mcall with a property-access variable chain
$expr = $mcall['expr'];
if ($expr['type'] !== 'mcall') { echo "TYPE_FAIL: " . $expr['type'] . "\n"; return; }
if ($expr['name'] !== 'doSomething') { echo "NAME_FAIL: " . $expr['name'] . "\n"; return; }

// The variable (receiver) should be a property-access expression
$variable = $expr['variable'];
if ($variable['type'] !== 'property-access') { echo "VAR_TYPE_FAIL: " . $variable['type'] . "\n"; return; }

echo "OK\n";
?>
--EXPECT--
OK
