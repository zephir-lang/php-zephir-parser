--TEST--
Tests closure definitions carrying a return type, in all eight closure forms
--SKIPIF--
<?php include(__DIR__ . '/../../skipif.inc'); ?>
--FILE--
<?php
$code =<<<ZEP
function forms() {
	let a = function () -> int { };
	let b = function () use (x) -> string { };
	let c = function () -> void { return; };
	let d = function () use (x) -> array { return []; };
	let e = function (p) -> bool { };
	let f = function (p) use (x) -> double { };
	let g = function (p) -> int|string { return 1; };
	let h = function (p) use (x) -> <\ArrayObject> { return null; };
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

$summary = [];
foreach ($ir[0]['statements'] as $statement) {
    $assignment = $statement['assignments'][0];
    $closure    = $assignment['expr'];
    $returnType = $closure['return-type'];

    $names = [];
    foreach ($returnType['list'] ?? [] as $item) {
        $names[] = $item['data-type'] ?? ('<' . $item['cast']['value'] . '>');
    }

    $summary[$assignment['variable']] = sprintf(
        'params=%d use=%d body=%d void=%d type=%s',
        isset($closure['left']) ? 1 : 0,
        isset($closure['use']) ? 1 : 0,
        isset($closure['right']) ? 1 : 0,
        $returnType['void'],
        implode('|', $names) ?: '-'
    );
}

var_dump($summary);
?>
--EXPECT--
array(8) {
  ["a"]=>
  string(37) "params=0 use=0 body=0 void=0 type=int"
  ["b"]=>
  string(40) "params=0 use=1 body=0 void=0 type=string"
  ["c"]=>
  string(35) "params=0 use=0 body=1 void=1 type=-"
  ["d"]=>
  string(39) "params=0 use=1 body=1 void=0 type=array"
  ["e"]=>
  string(38) "params=1 use=0 body=0 void=0 type=bool"
  ["f"]=>
  string(40) "params=1 use=1 body=0 void=0 type=double"
  ["g"]=>
  string(44) "params=1 use=0 body=1 void=0 type=int|string"
  ["h"]=>
  string(48) "params=1 use=1 body=1 void=0 type=<\ArrayObject>"
}
