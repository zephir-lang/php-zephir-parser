--TEST--
Nested property access with compound assignment operators (this->a->b += 1)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class Chain
{
    public a;

    public function test()
    {
        let this->a = new Chain();
        let this->a->a += 1;
        let this->a->a -= 2;
        let this->a->a .= "x";
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[1];
$methods = $class['definition']['methods'];
$test = null;
foreach ($methods as $m) {
    if ($m['name'] === 'test') { $test = $m; break; }
}
if (!$test) { echo "MISSING_METHOD\n"; return; }

$statements = $test['statements'];
$lets = [];
foreach ($statements as $st) {
    if ($st['type'] === 'let') { $lets[] = $st; }
}
if (count($lets) !== 4) { echo "WRONG_LET_COUNT: " . count($lets) . "\n"; return; }

// Second let: this->a->a += 1
$a2 = $lets[1]['assignments'][0];
if ($a2['assign-type'] !== 'property-access') { echo "ASSIGN_TYPE_FAIL: " . $a2['assign-type'] . "\n"; return; }
if ($a2['property'] !== 'a') { echo "PROPERTY_FAIL\n"; return; }
$op2 = $a2['operator'];
if ($op2 !== 'add-assign') { echo "OP2_FAIL: $op2\n"; return; }

// Third let: this->a->a -= 2
$a3 = $lets[2]['assignments'][0];
if ($a3['assign-type'] !== 'property-access') { echo "ASSIGN_TYPE3_FAIL\n"; return; }
$op3 = $a3['operator'];
if ($op3 !== 'sub-assign') { echo "OP3_FAIL: $op3\n"; return; }

// Fourth let: this->a->a .= "x"
$a4 = $lets[3]['assignments'][0];
if ($a4['assign-type'] !== 'property-access') { echo "ASSIGN_TYPE4_FAIL\n"; return; }
$op4 = $a4['operator'];
if ($op4 !== 'concat-assign') { echo "OP4_FAIL: $op4\n"; return; }

echo "OK\n";
?>
--EXPECT--
OK
