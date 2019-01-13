@ECHO off

REM This file is part of the Zephir Parser.
REM
REM (c) Zephir Team <team@zephir-lang.com>
REM
REM For the full copyright and license information, please view
REM the LICENSE file that was distributed with this source code.

REM Rewrite this using PowerShell
CD parser

cl lemon.c
DEL zephir.c zephir.h parser.c scanner.c
re2c -o scanner.c scanner.re
lemon -s zephir.lemon
ECHO #include ^<php.h^> > parser.c
TYPE zephir.c >> parser.c
TYPE base.c >> parser.c
