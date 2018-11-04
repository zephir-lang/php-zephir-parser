dnl config.m4 for extension zephir_parser

PHP_ARG_ENABLE(zephir_parser, whether to enable Zephir Parser,
[  --enable-zephir_parser           Enable Zephir Parser])

if test "$PHP_ZEPHIR_PARSER" = "yes"; then
	AC_DEFINE(HAVE_ZEPHIR_PARSER, 1, [Whether you have Zephir Parser])

	PHP_ZEPHIR_PARSER_CFLAGS="-I@ext_srcdir@/parser"

	EXT_ZEPHIR_PARSER_SOURCES="zephir_parser.c parser/parser.c parser/scanner.c"
	EXT_ZEPHIR_PARSER_HEADERS="zephir_parser.h parser/parser.h parser/parser.php5.inc.h parser/parser.php7.inc.h parser/parser.php5.h parser/parser.php7.h parser/scanner.h parser/xx.h"

	zephir_parser_sources="zephir_parser.c parser/parser.c parser/scanner.c"
	PHP_NEW_EXTENSION(zephir_parser, $EXT_ZEPHIR_PARSER_SOURCES, $ext_shared,, $PHP_ZEPHIR_PARSER_CFLAGS)
	ifdef([PHP_INSTALL_HEADERS], [
		PHP_INSTALL_HEADERS([ext/zephir_parser], $EXT_ZEPHIR_PARSER_HEADERS)
	])

	PHP_ADD_MAKEFILE_FRAGMENT
fi
