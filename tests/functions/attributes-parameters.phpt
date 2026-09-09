--TEST--
PHP attributes on parameters of methods, functions and closures (zephir#2466)
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
include __DIR__ . '/../attrdump.inc';
// The prefix is attached by a xx_attributed_parameter layer above xx_parameter,
// so one rule pair covers methods, interface methods, free functions and
// closures. On a variadic the `attributes` key still lands last, after
// `variadic`.
$code =<<<ZEP
class Handler
{
	public function run(#[Sensitive] string token, #[A] #[B(1)] int retries = 3, plain = null, #[C] ...rest)
	{
	}

	public function make()
	{
		let callback = function(#[D("x")] int value) {
			return value;
		};
	}
}

interface Contract
{
	public function handle(#[Sensitive] string secret);
}

function topLevel(#[E, F] var input)
{
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

function dump_parameters($label, $parameters)
{
	foreach ($parameters as $offset => $parameter) {
		echo $label, '#', $offset, ' ', $parameter['name'], ' | ', attr_render($parameter), "\n";
	}
}

dump_parameters('run', $ir[0]['definition']['methods'][0]['parameters']);
dump_parameters(
	'closure',
	$ir[0]['definition']['methods'][1]['statements'][0]['assignments'][0]['expr']['left']
);
dump_parameters('handle', $ir[1]['definition']['methods'][0]['parameters']);
dump_parameters('topLevel', $ir[2]['parameters']);

$rest = $ir[0]['definition']['methods'][0]['parameters'][3];
echo 'keys(rest)=', implode(',', array_keys($rest)), "\n";
echo 'keys(plain)=', implode(',', array_keys($ir[0]['definition']['methods'][0]['parameters'][2])), "\n";
?>
--EXPECT--
run#0 token | Sensitive
run#1 retries | A B(1)
run#2 plain | -
run#3 rest | C
closure#0 value | D("x")
handle#0 secret | Sensitive
topLevel#0 input | E F
keys(rest)=type,name,const,data-type,mandatory,reference,file,line,char,variadic,attributes
keys(plain)=type,name,const,data-type,mandatory,default,reference,file,line,char
