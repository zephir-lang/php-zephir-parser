--TEST--
Nested property access in expression context (reading a->b->c)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class Nested
{
    public a;

    public function read()
    {
        var x;
        let x = this->a->a;
        return x;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[1];
$methods = $class['definition']['methods'];
$read = null;
foreach ($methods as $m) {
    if ($m['name'] === 'read') { $read = $m; break; }
}
if (!$read) { echo "MISSING_METHOD\n"; return; }

$statements = $read['statements'];
$lets = [];
foreach ($statements as $st) {
    if ($st['type'] === 'let') { $lets[] = $st; }
}
if (count($lets) !== 1) { echo "WRONG_LET_COUNT: " . count($lets) . "\n"; return; }

// let x = this->a->a
// The RHS should be a property-access expression chain
$a = $lets[0]['assignments'][0];
if ($a['assign-type'] !== 'variable') { echo "ASSIGN_TYPE_FAIL: " . $a['assign-type'] . "\n"; return; }
$expr = $a['expr'];
if ($expr['type'] !== 'property-access') { echo "EXPR_TYPE_FAIL: " . $expr['type'] . "\n"; return; }
// Left of outer property-access should also be property-access
$left = $expr['left'];
if ($left['type'] !== 'property-access') { echo "LEFT_TYPE_FAIL: " . $left['type'] . "\n"; return; }

echo "OK\n";
?>
--EXPECT--
OK
