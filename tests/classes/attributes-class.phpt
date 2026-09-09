--TEST--
PHP attributes on class, interface, trait and function declarations (zephir#2466)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../attrdump.inc';
// A `#[...]` prefix is a wrapper rule one level above the declaration rules, so
// it composes with every existing class/interface/trait/function variant without
// touching them. `#[A] #[B]` and `#[A, B]` collapse into one flat `attributes`
// list, because the grouping carries no meaning in PHP either. A docblock stays
// its own top-level `comment` statement and therefore precedes the attributes.
$code =<<<ZEP
namespace Test;

use Test\Marker as M;

#[Marker]
class Plain {}

#[Marker(1, -2, 1.5, "s", true, false, null, [1, "k": "v"], flag: true)]
abstract class WithArgs {}

#[A]
#[B(2)]
final class Stacked {}

#[A, B(3)]
class Grouped {}

/**
 * Doc first, then attributes.
 */
#[M]
class Documented {}

#[Marker]
interface Contract {}

#[Marker]
trait Helper {}

#[Marker]
function topLevel() {}

class Bare {}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

$byName = [];
foreach ($ir as $statement) {
	if (in_array($statement['type'], ['class', 'interface', 'trait', 'function'], true)) {
		$byName[$statement['name']] = $statement;
		echo $statement['type'], ' ', $statement['name'], ' | ', attr_render($statement), "\n";
	}
}

// `attributes` is appended last, and is absent entirely from a declaration that
// carries none.
echo 'keys(Plain)=', implode(',', array_keys($byName['Plain'])), "\n";
echo 'keys(Bare)=', implode(',', array_keys($byName['Bare'])), "\n";
echo 'keys(attribute)=', implode(',', array_keys($byName['Plain']['attributes'][0])), "\n";
echo 'keys(argument)=', implode(',', array_keys($byName['WithArgs']['attributes'][0]['arguments'][8])), "\n";
?>
--EXPECT--
class Plain | Marker
class WithArgs | Marker(1, -2, 1.5, "s", true, false, null, [1, "k": "v"], flag: true)
class Stacked | A B(2)
class Grouped | A B(3)
class Documented | M
interface Contract | Marker
trait Helper | Marker
function topLevel | Marker
class Bare | -
keys(Plain)=type,name,abstract,final,file,line,char,attributes
keys(Bare)=type,name,abstract,final,file,line,char
keys(attribute)=type,name,file,line,char
keys(argument)=name,parameter,file,line,char
