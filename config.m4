dnl config.m4 for extension zephir_parser

PHP_ARG_ENABLE(zephir_parser, whether to enable Zephir Parser,
[  --enable-zephir_parser  Enable Zephir Parser])

if test "$PHP_ZEPHIR_PARSER" = "yes"; then
	AC_DEFINE(HAVE_ZEPHIR_PARSER, 1, [Whether you have Zephir Parser])

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
[  --enable-coverage       Enable code coverage])

if test "$PHP_COVERAGE" = "yes"; then
	if test "$GCC" != "yes"; then
		AC_MSG_ERROR([GCC is required for --enable-coverage])
	fi

	dnl Check if ccache is being used
	case `$php_shtool path $CC` in
		*ccache*[)] gcc_ccache=yes;;
		*[)] gcc_ccache=no;;
	esac

	if test "$gcc_ccache" = "yes" && (test -z "$CCACHE_DISABLE" || test "$CCACHE_DISABLE" != "1"); then
		err_msg=$(cat | tr '\012' ' ' <<ΕΟF
ccache must be disabled when --enable-coverage option is used.
You can disable ccache by setting environment variable CCACHE_DISABLE=1.
ΕΟF
		)

		AC_MSG_ERROR([$err_msg])
	fi

	lcov_version_list="1.5 1.6 1.7 1.9 1.10 1.11 1.12"

	AC_CHECK_PROG(LCOV, lcov, lcov)
	PHP_SUBST(LCOV)

	AC_CHECK_PROG(GENHTML, genhtml, genhtml)
	PHP_SUBST(GENHTML)

	if test "$LCOV"; then
		AC_CACHE_CHECK([for lcov version], php_cv_lcov_version, [
			php_cv_lcov_version=invalid
			lcov_version=`$LCOV -v 2>/dev/null | $SED -e 's/^.* //'` #'
			for lcov_check_version in $lcov_version_list; do
			if test "$lcov_version" = "$lcov_check_version"; then
				php_cv_lcov_version="$lcov_check_version (ok)"
			fi
		  done
		])
	else
		AC_MSG_ERROR([lcov testing requested but lcov not found])
	fi

	case $php_cv_lcov_version in
		""|invalid[)]
			lcov_msg="You must have one of the following versions of LCOV: $lcov_version_list (found: $lcov_version)."
		  	AC_MSG_ERROR([$lcov_msg])
		  	LCOV="exit 0;"
		  	;;
	esac

	if test -z "$GENHTML"; then
		AC_MSG_ERROR([Could not find genhtml from the LCOV package])
	fi

	dnl Remove all optimization flags from CFLAGS
	changequote({,})
	CFLAGS=`echo "$CFLAGS" | $SED -e 's/-O[0-9s]*//g'`
	CXXFLAGS=`echo "$CXXFLAGS" | $SED -e 's/-O[0-9s]*//g'`
	changequote([,])

	dnl Add the special gcc flags
	CFLAGS="$CFLAGS --coverage -O0 -ggdb -fprofile-arcs -ftest-coverage"
	CXXFLAGS="$CXXFLAGS --coverage -O0 -ggdb -fprofile-arcs -ftest-coverage"

	AC_DEFINE(USE_COVERAGE, 1, [Whether coverage is enabled])
fi
