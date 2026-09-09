--TEST--
Malformed attributes, and the places `#[` must NOT be recognised (zephir#2466)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
// `#[` is a two-character token, so a bare `#` keeps falling through to the
// scanner's catch-all error rule exactly as before.
//
// The second block is the mis-fire guard: STRING, SLCOMMENT, COMMENT and CBLOCK
// are each matched by ONE re2c regex that consumes the whole literal, so a `#[`
// inside any of them is never seen as a token. re2c's longest-match rule is
// what makes this hold, so it is asserted rather than assumed.
$rejected = [
	'bare hash'        => "class A {} #",
	'empty group'      => "#[]\nclass A {}",
	'lone comma'       => "#[,]\nclass A {}",
	'unclosed parens'  => "#[A(\nclass A {}",
	'unclosed group'   => "#[A\nclass A {}",
	'docblock after'   => "#[A]\n/**\n * d\n */\nclass A {}",
	'inside a body'    => "class A { public function m() { #[X] let y = 1; } }",
];

$accepted = [
	'in a string'      => "class A { public function m() { let s = \"x #[not] y\"; } }",
	'in a line comment' => "// #[nope]\nclass A {}",
	'in a docblock'     => "/**\n * #[nope]\n */\nclass A {}",
	'in a block comment' => "/* #[nope] */\nclass A {}",
	'in a cblock'      => "%{ #[nope] }%\nclass A {}",
];

foreach ($rejected as $label => $code) {
	$ir = zephir_parse_file($code, '(eval code)');
	echo $label, ' => ', $ir['type'], ': ', $ir['message'], "\n";
}

foreach ($accepted as $label => $code) {
	$ir = zephir_parse_file($code, '(eval code)');
	echo $label, ' => ok(', implode(',', array_column($ir, 'type')), ")\n";
}
?>
--EXPECT--
bare hash => error: Scanner error: -2 
empty group => error: Syntax error
lone comma => error: Syntax error
unclosed parens => error: Syntax error
unclosed group => error: Syntax error
docblock after => error: Syntax error
inside a body => error: Syntax error
in a string => ok(class)
in a line comment => ok(class)
in a docblock => ok(comment,class)
in a block comment => ok(class)
in a cblock => ok(cblock,class)
