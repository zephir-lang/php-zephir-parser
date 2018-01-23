--TEST--
Tests recognizing wrapping C-code in CBLOCKs
--SKIPIF--
<?php if (!extension_loaded("Zephir Parser")) print "skip The zephir_parser extension is not loaded"; ?>
--FILE--
<?php require(__DIR__ . "/../zephir_parser_test.inc");

$ir = parse_file("base/cblocks.zep");
var_dump($ir);
--EXPECTF--
array(2) {
  [0]=>
  array(5) {
    ["type"]=>
    string(9) "namespace"
    ["name"]=>
    string(7) "Example"
    ["file"]=>
    string(%d) "%s/tests/data/base/cblocks.zep"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
  [1]=>
  array(8) {
    ["type"]=>
    string(5) "class"
    ["name"]=>
    string(4) "Test"
    ["abstract"]=>
    int(0)
    ["final"]=>
    int(0)
    ["definition"]=>
    array(4) {
      ["methods"]=>
      array(1) {
        [0]=>
        array(8) {
          ["visibility"]=>
          array(1) {
            [0]=>
            string(6) "public"
          }
          ["type"]=>
          string(6) "method"
          ["name"]=>
          string(5) "block"
          ["statements"]=>
          array(1) {
            [0]=>
            array(5) {
              ["type"]=>
              string(6) "cblock"
              ["value"]=>
              string(81) "

			// Some comment

			{
				while(1) {
				    RETURN_MM_NULL();
				}
			}
		"
              ["file"]=>
              string(%d) "%s/tests/data/base/cblocks.zep"
              ["line"]=>
              int(17)
              ["char"]=>
              int(2)
            }
          }
          ["file"]=>
          string(%d) "%s/tests/data/base/cblocks.zep"
          ["line"]=>
          int(5)
          ["last-line"]=>
          int(18)
          ["char"]=>
          int(16)
        }
      }
      ["file"]=>
      string(%d) "%s/tests/data/base/cblocks.zep"
      ["line"]=>
      int(3)
      ["char"]=>
      int(5)
    }
    ["file"]=>
    string(%d) "%s/tests/data/base/cblocks.zep"
    ["line"]=>
    int(3)
    ["char"]=>
    int(5)
  }
}
