#!/usr/bin/env bash
#
# This file is part of the Zephir.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

export NO_INTERACTION=1
export REPORT_EXIT_STATUS=1
export ZEND_DONT_UNLOAD_MODULES=1
export USE_ZEND_ALLOC=0

if [ -z "${TEST_PHP_EXECUTABLE}" ]; then
	export TEST_PHP_EXECUTABLE=$(phpenv which php)
fi

PHP_VERNUM="$(`phpenv which php-config` --vernum)"
PROJECT_ROOT=$(readlink -enq "$(dirname $0)/../")

if [ "${PHP_VERNUM}" -lt 70300 ]; then
	if [ $(command -v valgrind 2>/dev/null) != "" ]; then
		export TEST_PHP_ARGS=-m
	else
		>&2 echo "Skip check for memory leaks due to unstable PHP version"
	fi
else
	>&2 echo "Skip check for memory leaks. Valgring does not exist"
fi

${TEST_PHP_EXECUTABLE} ${PROJECT_ROOT}/run-tests.php \
	-d extension=zephir_parser.so \
	-d extension_dir=${PROJECT_ROOT}/modules \
	-d variables_order=EGPCS \
	-n ${PROJECT_ROOT}/tests/*.phpt \
	-g "FAIL,XFAIL,BORK,WARN,SKIP" \
	--offline \
	--show-diff \
	--set-timeout 120
