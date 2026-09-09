--TEST--
Attribute names that collide with Zephir keywords (zephir#2466)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../attrdump.inc';
// Zephir matches its keywords case-insensitively, so `#[Deprecated]` lexes as
// XX_T_DEPRECATED rather than IDENTIFIER. Keyword tokens carry no text, so
// xx_attribute_name supplies the canonical spelling for the keywords that are
// plausible attribute names -- which also means `#[DEPRECATED]` and
// `#[deprecated]` normalize to `Deprecated`. PHP looks classes up
// case-insensitively, so that is lossless.
//
// Keyword terminals with TWO spellings are deliberately NOT accepted: XX_T_TYPE_DOUBLE
// matches both `double` and `float`, so a rule there would silently rewrite
// `#[Float]` to `#[Double]`. Such a name must be written qualified.
$code =<<<ZEP
#[Deprecated]
class A {}

#[Deprecated("since 2.0")]
class B {}

#[DEPRECATED]
class C {}

#[deprecated]
class D {}

#[Final, Static, Internal, Readonly, Default, Case, Empty, Void, Reverse, Inline]
class E {}

#[\Deprecated]
class F {}

#[App\Case]
class G {}

#[Override]
class H {}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir as $statement) {
	if ('class' === $statement['type']) {
		echo $statement['name'], ' | ', attr_render($statement), "\n";
	}
}

// `float` shares its terminal with `double`, so it is not in the keyword
// whitelist and an unqualified `#[Float]` must stay a syntax error rather than
// silently become `#[Double]`.
$lossy = zephir_parse_file("#[Float]\nclass I {}\n", '(eval code)');
echo 'Float => ', $lossy['type'], ': ', $lossy['message'], "\n";
?>
--EXPECT--
A | Deprecated
B | Deprecated("since 2.0")
C | Deprecated
D | Deprecated
E | Final Static Internal Readonly Default Case Empty Void Reverse Inline
F | \Deprecated
G | App\Case
H | Override
Float => error: Syntax error
