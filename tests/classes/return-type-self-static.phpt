--TEST--
Method return types: <self> and <static>
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php
$code = <<<ZEP
class MyClass {
    public function selfReturn() -> <self> {
        return new self();
    }

    public function staticReturn() -> <static> {
        return new static();
    }
}
ZEP;

$ir = zephir_parse_file($code, '(eval code)');
foreach ($ir[0]["definition"]["methods"] as $method) {
    $cast = $method["return-type"]["list"][0]["cast"]["value"];
    printf("%s -> <%s>\n", $method["name"], $cast);
}
?>
--EXPECT--
selfReturn -> <self>
staticReturn -> <static>
