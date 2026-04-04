--TEST--
All-caps variable names in let assignment variants (issue #39)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
function stmt($code) {
    $ir = zephir_parse_file($code, '(eval code)');
    return $ir[0]['definition']['methods'][0]['statements'][0]['assignments'][0];
}

// let LU = 1  (plain variable assignment)
$a = stmt('class Foo { public function bar() { let LU = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);

// let LU->prop = 1  (all-caps receiver)
$a = stmt('class Foo { public function bar() { let LU->prop = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);
var_dump($a['property']);

// let obj->LU = 1  (all-caps property)
$a = stmt('class Foo { public function bar() { let obj->LU = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);
var_dump($a['property']);

// let LU[] = 1  (all-caps array append)
$a = stmt('class Foo { public function bar() { let LU[] = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);

// let LU[0] = 1  (all-caps array index)
$a = stmt('class Foo { public function bar() { let LU[0] = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);

// let RBF::PROP = 1  (all-caps static class and property)
$a = stmt('class Foo { public function bar() { let RBF::PROP = 1; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);
var_dump($a['property']);

// let LU++  (all-caps increment)
$a = stmt('class Foo { public function bar() { let LU++; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);

// let LU--  (all-caps decrement)
$a = stmt('class Foo { public function bar() { let LU--; } }');
var_dump($a['assign-type']);
var_dump($a['variable']);
?>
--EXPECT--
string(8) "variable"
string(2) "LU"
string(15) "object-property"
string(2) "LU"
string(4) "prop"
string(15) "object-property"
string(3) "obj"
string(2) "LU"
string(15) "variable-append"
string(2) "LU"
string(11) "array-index"
string(2) "LU"
string(15) "static-property"
string(3) "RBF"
string(4) "PROP"
string(4) "incr"
string(2) "LU"
string(4) "decr"
string(2) "LU"

