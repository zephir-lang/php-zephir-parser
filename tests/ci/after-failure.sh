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

# The -e flag causes the script to exit as soon as one command returns a non-zero exit code.
# This can be handy if you want whatever script you have to exit early.
# It also helps in complex installation scripts where one failed command wouldn’t otherwise cause the installation to fail.
set -ev

if [ -f "${TRAVIS_BUILD_DIR}/configure.log" ]; then
	cat "${TRAVIS_BUILD_DIR}/configure.log"
fi

ls -al ${TRAVIS_BUILD_DIR}
