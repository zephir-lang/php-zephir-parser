#!/usr/bin/env bash
#
# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

set -e

NO_INTERACTION=1
REPORT_EXIT_STATUS=1
ZEND_DONT_UNLOAD_MODULES=1
USE_ZEND_ALLOC=0

export NO_INTERACTION REPORT_EXIT_STATUS ZEND_DONT_UNLOAD_MODULES USE_ZEND_ALLOC
if [ -z "${TEST_PHP_EXECUTABLE}" ]; then
	TEST_PHP_EXECUTABLE="$(phpenv which php)"
  export TEST_PHP_EXECUTABLE
fi

PHP_VERNUM="$($(phpenv which php-config) --vernum)"
PROJECT_ROOT="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." >/dev/null 2>&1 && pwd )"

if [ "${PHP_VERNUM}" -lt 70300 ]; then
	if [ -n "$(command -v valgrind 2>/dev/null)" ]; then
		TEST_PHP_ARGS=-m
    export TEST_PHP_ARGS
	else
		>&2 echo "Skip check for memory leaks. Valgring does not exist"
	fi
else
	>&2 echo "Skip check for memory leaks due to unstable PHP version"
fi

${TEST_PHP_EXECUTABLE} "${PROJECT_ROOT}/run-tests.php" \
	-d extension=zephir_parser.so \
	-d extension_dir="${PROJECT_ROOT}/modules" \
	-d variables_order=EGPCS \
	-n "${PROJECT_ROOT}/tests/*.phpt" \
	-g "FAIL,XFAIL,BORK,WARN,SKIP" \
	--offline \
	--show-diff \
	--set-timeout 120
