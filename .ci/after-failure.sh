#!/usr/bin/env bash
#
# This file is part of the Zephir.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

# The -e flag causes the script to exit as soon as one command returns a
# non-zero exit code.  This can be handy if you want whatever script you have
# to exit early.  It also helps in complex installation scripts where one
# failed command wouldn’t otherwise cause the installation to fail.
set -ev

PROJECT_ROOT=$(readlink -enq "$(dirname $0)/../")

if [ -f "${PROJECT_ROOT}/configure.log" ]; then
	cat "${PROJECT_ROOT}/configure.log"
fi

ls -al ${PROJECT_ROOT}
