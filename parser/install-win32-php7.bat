cl lemon.c
del parser.c parser.h scanner.c
re2c -o scanner.c scanner.re
lemon -s parser.php7.lemon
type parser.php7.c > parser.c
type base.c >> parser.c
