--TEST--
Object property array index assignment (this->items[0] = value)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<'ZEP'
namespace Debug;

class Container
{
    public items;

    public function set()
    {
        let this->items[0] = "hello";
        let this->items["key"] = "world";
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
$class = $ir[1];
$methods = $class['definition']['methods'];
$set = null;
foreach ($methods as $m) {
    if ($m['name'] === 'set') { $set = $m; break; }
}
if (!$set) { echo "MISSING_METHOD\n"; return; }

$statements = $set['statements'];
$lets = [];
foreach ($statements as $st) {
    if ($st['type'] === 'let') { $lets[] = $st; }
}
if (count($lets) !== 2) { echo "WRONG_LET_COUNT: " . count($lets) . "\n"; return; }

// First: this->items[0] = "hello"
$a1 = $lets[0]['assignments'][0];
if ($a1['assign-type'] !== 'object-property-array-index') {
    echo "TYPE_FAIL_1: " . $a1['assign-type'] . "\n"; return;
}
if ($a1['variable'] !== 'this') { echo "VAR_FAIL_1\n"; return; }
if ($a1['property'] !== 'items') { echo "PROP_FAIL_1\n"; return; }

// Second: this->items["key"] = "world"
$a2 = $lets[1]['assignments'][0];
if ($a2['assign-type'] !== 'object-property-array-index') {
    echo "TYPE_FAIL_2: " . $a2['assign-type'] . "\n"; return;
}

echo "OK\n";
?>
--EXPECT--
OK
