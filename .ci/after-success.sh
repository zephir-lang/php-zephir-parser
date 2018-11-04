#!/usr/bin/env bash
#
# This file is part of the Zephir.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

PROJECT_ROOT=$(readlink -enq "$(dirname $0)/../")

if [ "${REPORT_COVERAGE}" = "1" ]; then
	output=${PROJECT_ROOT}/coverage.info

	lcov --no-checksum \
		--directory ${PROJECT_ROOT}/parser \
		--directory ${PROJECT_ROOT} \
		--capture \
		--compat-libtool \
		--output-file ${output}

	lcov --remove ${output} "/usr*" \
		--remove ${output} "*/.phpenv/*" \
		--remove ${output} "${HOME}/build/include/*" \
		--compat-libtool \
		--output-file ${output}

	if [ ! -z "${CODECOV_TOKEN}" ]; then
		bash <(curl -s https://codecov.io/bash)
	fi
fi
