--TEST--
Destructuring assignment: let [a, b, c] = expr (issue #18)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
function stmt($code) {
    $ir = zephir_parse_file('class F { public function b() { ' . $code . ' } }', '(eval code)');
    return $ir[0]['definition']['methods'][0]['statements'][0]['assignments'][0];
}

// 1) Basic two-variable destructure
$a = stmt('let [a, b] = arr;');
var_dump($a['assign-type']);
var_dump($a['operator']);
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['expr']['type']);
var_dump($a['expr']['value']);

// 2) Three variables
$a = stmt('let [x, y, z] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['variables'][2]['value']);

// 3) Five variables
$a = stmt('let [a, b, c, d, e] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][4]['value']);

// 4) Single variable
$a = stmt('let [x] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);

// 5) Skipped slot in middle: let [a, , c] = arr;
$a = stmt('let [a, , c] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]);
var_dump($a['variables'][2]['value']);

// 6) Leading skip: let [, b] = arr;
$a = stmt('let [, b] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]);
var_dump($a['variables'][1]['value']);

// 7) Trailing skip: let [a, ] = arr;
$a = stmt('let [a, ] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]);

// 8) Multiple consecutive skips: let [a, , , d] = arr;
$a = stmt('let [a, , , d] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]);
var_dump($a['variables'][2]);
var_dump($a['variables'][3]['value']);

// 9) All-caps (CONSTANT token) variable names
$a = stmt('let [A, B] = arr;');
var_dump($a['assign-type']);
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);

// 10) Mixed case names
$a = stmt('let [a, B, c] = arr;');
var_dump(count($a['variables']));
var_dump($a['variables'][0]['value']);
var_dump($a['variables'][1]['value']);
var_dump($a['variables'][2]['value']);

// 11) RHS: function call
$a = stmt('let [w, h] = getimagesize(path);');
var_dump($a['expr']['type']);

// 12) RHS: method call
$a = stmt('let [a, b] = this->getData();');
var_dump($a['expr']['type']);

// 13) RHS: static call
$a = stmt('let [a, b] = MyClass::split(str);');
var_dump($a['expr']['type']);

// 14) RHS: array literal
$a = stmt('let [a, b] = [1, 2];');
var_dump($a['expr']['type']);

// 15) RHS: ternary expression
$a = stmt('let [a, b] = cond ? x : y;');
var_dump($a['expr']['type']);

// 16) RHS: new object
$a = stmt('let [a, b] = new MyObj();');
var_dump($a['expr']['type']);

// 17) RHS: property access
$a = stmt('let [a, b] = obj->items;');
var_dump($a['expr']['type']);

// 18) RHS: array access
$a = stmt('let [a, b] = arr[0];');
var_dump($a['expr']['type']);

// 19) Mixed with normal assignment in same let: let x = 1, [a, b] = arr;
$ir = zephir_parse_file('class F { public function b() { let x = 1, [a, b] = arr; } }', '(eval code)');
$assigns = $ir[0]['definition']['methods'][0]['statements'][0]['assignments'];
var_dump(count($assigns));
var_dump($assigns[0]['assign-type']);
var_dump($assigns[0]['variable']);
var_dump($assigns[1]['assign-type']);
var_dump(count($assigns[1]['variables']));

// 20) Multiple destructures in one let: let [a, b] = x, [c, d] = y;
$ir = zephir_parse_file('class F { public function b() { let [a, b] = x, [c, d] = y; } }', '(eval code)');
$assigns = $ir[0]['definition']['methods'][0]['statements'][0]['assignments'];
var_dump(count($assigns));
var_dump($assigns[0]['assign-type']);
var_dump($assigns[0]['variables'][0]['value']);
var_dump($assigns[1]['assign-type']);
var_dump($assigns[1]['variables'][0]['value']);

// 21) Destructure inside namespace
$ir = zephir_parse_file('namespace Ns; class F { public function b() { let [a, b] = arr; } }', '(eval code)');
$a = $ir[1]['definition']['methods'][0]['statements'][0]['assignments'][0];
var_dump($a['assign-type']);
var_dump(count($a['variables']));
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
int(5)
string(1) "e"
int(1)
string(1) "x"
int(3)
string(1) "a"
NULL
string(1) "c"
int(2)
NULL
string(1) "b"
int(2)
string(1) "a"
NULL
int(4)
string(1) "a"
NULL
NULL
string(1) "d"
string(11) "destructure"
string(1) "A"
string(1) "B"
int(3)
string(1) "a"
string(1) "B"
string(1) "c"
string(5) "fcall"
string(5) "mcall"
string(5) "scall"
string(5) "array"
string(7) "ternary"
string(3) "new"
string(15) "property-access"
string(12) "array-access"
int(2)
string(8) "variable"
string(1) "x"
string(11) "destructure"
int(2)
int(2)
string(11) "destructure"
string(1) "a"
string(11) "destructure"
string(1) "c"
string(11) "destructure"
int(2)

