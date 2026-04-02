--TEST--
Nested property access in let assignment (this->arr->arr = 1)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class ZephirDebug
{
    public arr;

    public static function test()
    {
        let this->arr = new ZephirDebug();
        let this->arr->arr = 1;
    }
}
ZEP;

try {
    $ir = zephir_parse_file($code, '(eval code)');
    // Find the class definition and its method to assert assignments exist
    $class = $ir[1];
    $methods = $class['definition']['methods'];
    $testMethod = null;
    foreach ($methods as $m) {
        if ($m['name'] === 'test') { $testMethod = $m; break; }
    }
    if (!$testMethod) {
        echo "MISSING_METHOD\n"; exit; }
    $statements = $testMethod['statements'];
    $lets = [];
    foreach ($statements as $st) { if ($st['type'] === 'let') { $lets[] = $st; } }
    if (count($lets) !== 2) { echo "WRONG_LET_COUNT\n"; exit; }
    $a1 = $lets[0]['assignments'][0];
    $a2 = $lets[1]['assignments'][0];
    // First assignment should be a simple object property
    if ($a1['assign-type'] !== 'object-property' || $a1['property'] !== 'arr') { echo "FIRST_ASSIGN_FAIL\n"; exit; }
    // Second assignment should represent nested property access (current helper names it 'property-access')
    if ($a2['assign-type'] !== 'property-access' || $a2['property'] !== 'arr') { echo "SECOND_ASSIGN_FAIL\n"; exit; }
    // Ensure left side is a property-access expression chain
    if ($a2['left']['type'] !== 'property-access') { echo "LEFT_EXPR_FAIL\n"; exit; }
    echo "OK\n";
} catch (Throwable $e) {
    echo 'EXCEPTION: ' . $e->getMessage() . "\n";
}
?>
--EXPECT--
OK

