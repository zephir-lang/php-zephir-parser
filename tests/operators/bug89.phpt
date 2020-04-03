--TEST--
Tests bitwise operators priority
--SKIPIF--
<?php include(__DIR__ . '/../skipif.inc'); ?>
--FILE--
<?php

$code =<<<ZEP
function test () {
    let t = u & v << 7;
}
ZEP;

echo json_encode(
    zephir_parse_file($code, '(eval code)'),
    JSON_PRETTY_PRINT
);

?>
--EXPECT--
[
    {
        "type": "function",
        "name": "test",
        "statements": [
            {
                "type": "let",
                "assignments": [
                    {
                        "assign-type": "variable",
                        "operator": "assign",
                        "variable": "t",
                        "expr": {
                            "type": "bitwise_and",
                            "left": {
                                "type": "variable",
                                "value": "u",
                                "file": "(eval code)",
                                "line": 2,
                                "char": 15
                            },
                            "right": {
                                "type": "bitwise_shiftleft",
                                "left": {
                                    "type": "variable",
                                    "value": "v",
                                    "file": "(eval code)",
                                    "line": 2,
                                    "char": 20
                                },
                                "right": {
                                    "type": "int",
                                    "value": "7",
                                    "file": "(eval code)",
                                    "line": 2,
                                    "char": 23
                                },
                                "file": "(eval code)",
                                "line": 2,
                                "char": 23
                            },
                            "file": "(eval code)",
                            "line": 2,
                            "char": 23
                        },
                        "file": "(eval code)",
                        "line": 2,
                        "char": 23
                    }
                ],
                "file": "(eval code)",
                "line": 3,
                "char": 1
            }
        ],
        "file": "(eval code)",
        "line": 1,
        "char": 9
    }
]
