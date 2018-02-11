#!/usr/bin/env bash
#
# Zephir Parser
#
# Copyright (c) 2013-present Zephir Team and contributors
#
# This source file is subject the MIT license, that is bundled with
# this package in the file LICENSE, and is available through the
# world-wide-web at the following url:
# http://zephir-lang.com/license.html
#
# If you did not receive a copy of the MIT license and are unable
# to obtain it through the world-wide-web, please send a note to
# license@zephir-lang.com so we can mail you a copy immediately.

CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

PHP_MAJOR="$(`phpenv which php` -r 'echo phpversion();' | cut -d '.' -f 1)"
PHP_MINOR="$(`phpenv which php` -r 'echo phpversion();' | cut -d '.' -f 2)"

if [ "${PHP_MAJOR}.${PHP_MINOR}" = "7.2" ] || [ "${PHP_MAJOR}.${PHP_MINOR}" = "7.3" ]; then
	export PHP_LEAKS_SUPPRESSION_FILE=${CURRENT_DIR}/../php-travis-leaks.supp
else
	export PHP_LEAKS_SUPPRESSION_FILE=${CURRENT_DIR}/../php-leaks.supp
fi

valgrind \
	--read-var-info=yes \
	--error-exitcode=1 \
	--fullpath-after= \
	--track-origins=yes \
	--leak-check=full \
	--num-callers=20 \
	--run-libc-freeres=no \
	--suppressions=${PHP_LEAKS_SUPPRESSION_FILE} \
	$(phpenv which php) \
		-d variables_order=EGPCS \
		run-tests.php \
		-p $(phpenv which php) \
		-d extension=${CURRENT_DIR}/../../modules/zephir_parser.so \
		-d variables_order=EGPCS \
		-g "FAIL,XFAIL,BORK,WARN,SKIP" \
		--offline \
		--show-diff \
		--set-timeout 120
