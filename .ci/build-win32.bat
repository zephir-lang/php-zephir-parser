REM Rewrite this using PowerShell
CD parser

cl lemon.c
DEL zephir.c zephir.h parser.c scanner.c
re2c -o scanner.c scanner.re
lemon -s zephir.lemon
ECHO #include ^<php.h^> > parser.c
TYPE zephir.c >> parser.c
TYPE base.c >> parser.c
