dnl config.m4 for extension zephir_parser

dnl Functions -----------------------------------------------------------------
AC_DEFUN([PHP_ZEPHIR_PARSER_ADD_SOURCES], [
  PHP_ZEPHIR_PARSER_SOURCES="$PHP_ZEPHIR_PARSER_SOURCES $1"
])

AC_DEFUN([PHP_ZEPHIR_PARSER_ADD_HEADERS], [
  PHP_ZEPHIR_PARSER_HEADERS="$PHP_ZEPHIR_PARSER_HEADERS $1"
])

AC_DEFUN([PHP_ZEPHIR_PARSER_ADD_FLAGS], [
  PHP_ZEPHIR_PARSER_FLAGS="$PHP_ZEPHIR_PARSER_FLAGS $1"
])

dnl Zephir Parser -------------------------------------------------------------
PHP_ARG_ENABLE(zephir-parser, whether to enable Zephir Parser,
dnl Make sure that the comment is aligned:
[  --enable-zephir-parser  Enable Zephir Parser], yes)

dnl Debug Mode ----------------------------------------------------------------
PHP_ARG_ENABLE(zephir-parser-debug,
whether to enable debugging support in Zephir Parser,
dnl Make sure that the comment is aligned:
[  --enable-zephir-parser-debug
                          Enable debugging support in Zephir Parser], no, no)

dnl Main ----------------------------------------------------------------------
if test "$PHP_ZEPHIR_PARSER" = "yes"; then
  AC_MSG_CHECKING([for PHP version])
  _found_version=`${PHP_CONFIG} --version`
  _found_vernum=`${PHP_CONFIG} --vernum`

  if test "$_found_vernum" -lt "70000"; then
    AC_MSG_ERROR(
      [not supported. Need a PHP version >= 7.0.0 (found $_found_version)]
    )
  else
      AC_MSG_RESULT([$_found_version (ok)])
  fi

  AC_DEFINE(HAVE_ZEPHIR_PARSER, 1, [Whether you have Zephir Parser])

  if test "$PHP_ZEPHIR_PARSER_DEBUG" != "no"; then
    AC_DEFINE(USE_ZEPHIR_PARSER_DEBUG, 1,
      [Include debugging support in Zephir Parser])
  fi

  PHP_ZEPHIR_PARSER_ADD_FLAGS([-I@ext_srcdir@/parser])

  PHP_ZEPHIR_PARSER_ADD_SOURCES([
    zephir_parser.c
    parser/parser.c
    parser/scanner.c
  ])

  PHP_ZEPHIR_PARSER_ADD_HEADERS([
    zephir_parser.h
    parser/parser.h
    parser/scanner.h
    parser/xx.h
    parser/zephir.h
  ])

  PHP_NEW_EXTENSION(zephir_parser, $PHP_ZEPHIR_PARSER_SOURCES, $ext_shared,, $PHP_ZEPHIR_PARSER_FLAGS)

  ifdef([PHP_INSTALL_HEADERS],
    [PHP_INSTALL_HEADERS([ext/zephir_parser], $PHP_ZEPHIR_PARSER_HEADERS)])

  PHP_ADD_MAKEFILE_FRAGMENT([parser.mk])

  dnl Create directories because PECL can't
  if test ! -d parser; then
    mkdir parser
  fi
fi

dnl Code Coverage -------------------------------------------------------------
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
  LDFLAGS=`echo "$LDFLAGS" | $SED -e 's/--coverage)//g' -e 's/-fprofile-arcs//g' -e 's/-ftest-coverage//g'`
  changequote([,])

  dnl Add the special flags
  if test "$($CC --version | head -n 1 | cut -d' ' -f1)" = "Apple"; then
    LDFLAGS="$LDFLAGS -fprofile-arcs -ftest-coverage"
  else
    LDFLAGS="$LDFLAGS -coverage"
  fi

  CFLAGS="$CFLAGS -O0 -ggdb -fprofile-arcs -ftest-coverage"
  CXXFLAGS="$CXXFLAGS -O0 -ggdb -fprofile-arcs -ftest-coverage"

  PHP_ADD_MAKEFILE_FRAGMENT([coverage.mk])

  AC_DEFINE(USE_COVERAGE, 1, [Whether coverage is enabled])
fi
