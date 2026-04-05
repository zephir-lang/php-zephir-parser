--TEST--
Destructuring assignment error cases (issue #18)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
function check($code) {
    $ir = zephir_parse_file('class F { public function b() { ' . $code . ' } }', '(eval code)');
    return isset($ir['type']) && $ir['type'] === 'error' ? 'error' : 'ok';
}

// 1) Compound operator += is not valid
var_dump(check('let [a, b] += arr;'));

// 2) Compound operator -= is not valid
var_dump(check('let [a, b] -= arr;'));

// 3) Compound operator .= is not valid
var_dump(check('let [a, b] .= arr;'));

// 4) Compound operator *= is not valid
var_dump(check('let [a, b] *= arr;'));

// 5) Nested brackets: let [[a, b]] = arr;
var_dump(check('let [[a, b]] = arr;'));

// 6) Integer literals in destructure target: let [1, 2] = arr;
var_dump(check('let [1, 2] = arr;'));

// 7) String literals in destructure target: let ["a", "b"] = arr;
var_dump(check('let ["a", "b"] = arr;'));

// 8) Expression in destructure target: let [a + b] = arr;
var_dump(check('let [a + b] = arr;'));

// 9) Missing RHS: let [a, b] = ;
var_dump(check('let [a, b] = ;'));

// 10) Missing equals: let [a, b] arr;
var_dump(check('let [a, b] arr;'));
?>
--EXPECT--
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"
string(5) "error"

