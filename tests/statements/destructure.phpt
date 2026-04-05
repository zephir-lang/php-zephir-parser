--TEST--
Destructuring assignment: let [a, b, c] = expr (issue #18)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
function stmt($code) {
    $ir = zephir_parse_file($code, '(eval code)');
    return $ir[0]['definition']['methods'][0]['statements'][0]['assignments'][0];
}

// Basic: let [a, b] = arr;
$a = stmt('class Foo { public function bar() { let [a, b] = arr; } }');
var_dump($a['assign-type']);
var_dump($a['operator']);
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['expr']['type']);
var_dump($a['expr']['value']);

// Three variables: let [x, y, z] = arr;
$a = stmt('class Foo { public function bar() { let [x, y, z] = arr; } }');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['variables'][2]['value']);

// Skipped slot: let [a, , c] = arr;
$a = stmt('class Foo { public function bar() { let [a, , c] = arr; } }');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]);
var_dump($a['variables'][2]['value']);

// All-caps (CONSTANT token) names: let [A, B] = arr;
$a = stmt('class Foo { public function bar() { let [A, B] = arr; } }');
var_dump($a['assign-type']);
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);

// Mixed case: let [a, B, c] = arr;
$a = stmt('class Foo { public function bar() { let [a, B, c] = arr; } }');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['variables'][2]['value']);

// RHS is a function call expression: let [w, h] = getimagesize(path);
$a = stmt('class Foo { public function bar() { let [w, h] = getimagesize(path); } }');
var_dump($a['assign-type']);
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['expr']['type']);
?>
--EXPECT--
string(11) "destructure"
string(6) "assign"
int(2)
string(1) "a"
string(1) "b"
string(8) "variable"
string(3) "arr"
int(3)
string(1) "x"
string(1) "y"
string(1) "z"
int(3)
string(1) "a"
NULL
string(1) "c"
string(11) "destructure"
string(1) "A"
string(1) "B"
int(3)
string(1) "a"
string(1) "B"
string(1) "c"
string(11) "destructure"
string(1) "w"
string(1) "h"
string(5) "fcall"

