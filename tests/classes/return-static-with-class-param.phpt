--TEST--
Method with class-typed parameter and -> <static> return must parse
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<ZEP
class AssetCollection {
    public function add(<AssetInterface> asset) -> <static> {
        this->addAsset(asset);
        return this;
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');

// Reject the legacy "error" envelope shape (returned by pre-2.0.1 parsers
// when they can't match a grammar rule for the `<static>` return type).
if (isset($ir['type']) && $ir['type'] === 'error') {
    printf("FAIL: %s @ line %d\n", $ir['message'], $ir['line']);
    exit;
}

$method = $ir[0]['definition']['methods'][0];
printf("name=%s\n", $method['name']);
printf("param-cast=%s\n", $method['parameters'][0]['cast']['value']);
printf("return-cast=%s\n", $method['return-type']['list'][0]['cast']['value']);
?>
--EXPECT--
name=add
param-cast=AssetInterface
return-cast=static
