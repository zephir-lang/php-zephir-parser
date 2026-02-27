--TEST--
Deep nested property access in let assignment (this->a->b->c = 42)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class Chain
{
    public a;
    public b;
    public c;

    public function make()
    {
        let this->a = new Chain();
        let this->a->b = new Chain();
        let this->a->b->c = 42;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[1];
$methods = $class['definition']['methods'];
$make = null;
foreach ($methods as $m) {
    if ($m['name'] === 'make') { $make = $m; break; }
}
if (!$make) { echo "MISSING_METHOD\n"; return; }
$statements = $make['statements'];
$lets = [];
foreach ($statements as $st) { if ($st['type'] === 'let') { $lets[] = $st; } }
if (count($lets) !== 3) { echo "WRONG_LET_COUNT\n"; return; }
$a1 = $lets[0]['assignments'][0];
$a2 = $lets[1]['assignments'][0];
$a3 = $lets[2]['assignments'][0];
// Validate assign types
if ($a1['assign-type'] !== 'object-property' || $a1['property'] !== 'a') { echo "FIRST_FAIL\n"; return; }
if ($a2['assign-type'] !== 'property-access' || $a2['property'] !== 'b') { echo "SECOND_FAIL\n"; return; }
if ($a3['assign-type'] !== 'property-access' || $a3['property'] !== 'c') { echo "THIRD_FAIL\n"; return; }
// Check left chain forms
if ($a2['left']['type'] !== 'property-access') { echo "CHAIN2_FAIL\n"; return; }
if ($a3['left']['type'] !== 'property-access') { echo "CHAIN3_FAIL\n"; return; }
// Ensure deepest chain left-left structure ends with identifier 'a'
$left = $a3['left'];
// Walk back one level: left = ( (this->a->b) ) -> retrieve its left
$l2 = $left['left'];
$l3 = $l2['left']; // Should be identifier 'this'
if ($l2['right']['value'] !== 'b') { echo "B_PROP_MISSING\n"; return; }
if ($l3['right']['value'] !== 'a') { echo "A_PROP_MISSING\n"; return; }
echo "OK\n";
?>
--EXPECT--
OK

