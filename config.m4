dnl config.m4 for extension zephir_parser

PHP_ARG_ENABLE(zephir_parser, whether to enable Zephir Parser,
[  --enable-zephir_parser  Enable Zephir Parser], yes)

PHP_ARG_ENABLE(parser-debug, whether to enable debug mode,
[  --enable-parser-debug   Enable debug mode], no, no)

if test "$PHP_ZEPHIR_PARSER" = "yes"; then
	AC_DEFINE(HAVE_ZEPHIR_PARSER, 1, [Whether you have Zephir Parser])

	if test "$PHP_PARSER_DEBUG" != "no"; then
		AC_DEFINE(PARSER_DEBUG, 1, [Whether to enable debug mode])
	fi

	PHP_ZEPHIR_PARSER_CFLAGS="-I@ext_srcdir@/parser"

	EXT_ZEPHIR_PARSER_SOURCES="zephir_parser.c parser/parser.c parser/scanner.c"
	EXT_ZEPHIR_PARSER_HEADERS="zephir_parser.h parser/parser.h parser/parser.php5.inc.h \
								parser/parser.php7.inc.h parser/parser.php5.h \
								parser/parser.php7.h parser/scanner.h parser/xx.h"

	PHP_NEW_EXTENSION(zephir_parser, $EXT_ZEPHIR_PARSER_SOURCES, $ext_shared,, \\$(PHP_ZEPHIR_PARSER_CFLAGS))
	ifdef([PHP_INSTALL_HEADERS], [
		PHP_INSTALL_HEADERS([ext/zephir_parser], $EXT_ZEPHIR_PARSER_HEADERS)
	])

	PHP_ADD_MAKEFILE_FRAGMENT
fi

PHP_ARG_ENABLE(coverage, whether to include code coverage symbols,
[  --enable-coverage       Enable code coverage], no, no)

if test "$PHP_COVERAGE" != "no"; then
	dnl Check if ccache is being used
	case `$php_shtool path $CC` in
		*ccache*[)] ccache=yes;;
		*[)] ccache=no;;
	esac

	if test "$ccache" = "yes" && (test -z "$CCACHE_DISABLE" || test "$CCACHE_DISABLE" != "1"); then
		err_msg=$(cat | tr '\012' ' ' <<ΕΟF
ccache must be disabled when --enable-coverage option is used.
You can disable ccache by setting environment variable CCACHE_DISABLE=1.
ΕΟF
		)

		AC_MSG_ERROR([$err_msg])
	fi

	AC_CHECK_PROG(LCOV, lcov, lcov)
	PHP_SUBST(LCOV)

	if test -z "$LCOV"; then
		AC_MSG_ERROR([lcov testing requested but lcov not found])
	fi

	AC_CHECK_PROG(GENHTML, genhtml, genhtml)
	PHP_SUBST(GENHTML)

	if test -z "$GENHTML"; then
		AC_MSG_ERROR([Could not find genhtml from the LCOV package])
	fi

	changequote({,})
	dnl Remove all optimization flags from CFLAGS
	CFLAGS=`echo "$CFLAGS" | $SED -e 's/-O[0-9s]*//g'`
	CXXFLAGS=`echo "$CXXFLAGS" | $SED -e 's/-O[0-9s]*//g'`
	dnl Remove --coverage flag from LDFLAGS
	LDFLAGS=`echo "$LDFLAGS" | $SED -e 's/--coverage//g'`
	changequote([,])

	dnl Add the special flags
	LDFLAGS="$LDFLAGS --coverage"
	CFLAGS="$CFLAGS -O0 -ggdb -fprofile-arcs -ftest-coverage"
	CXXFLAGS="$CXXFLAGS -O0 -ggdb -fprofile-arcs -ftest-coverage"

	AC_DEFINE(USE_COVERAGE, 1, [Whether coverage is enabled])
fi
