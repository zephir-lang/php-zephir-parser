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
TEST_PHP_EXECUTABLE="$(phpenv which php)"
TEST_PHP_ARGS=

if [ -n "$(command -v valgrind 2>/dev/null || true)" ]; then
  TEST_PHP_ARGS=-m
fi

export NO_INTERACTION REPORT_EXIT_STATUS TEST_PHP_EXECUTABLE TEST_PHP_ARGS

PROJECT_ROOT="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." >/dev/null 2>&1 && pwd )"

${TEST_PHP_EXECUTABLE} "${PROJECT_ROOT}/run-tests.php" \
  -d "error_reporting=32767" \
  -d "display_errors=1" \
  -d "display_startup_errors=1" \
  -d "log_errors=0" \
  -d "report_memleaks=1" \
  -d 'extension=zephir_parser.so' \
  -d "extension_dir=$PROJECT_ROOT/modules" \
  -n "$PROJECT_ROOT/tests/*.phpt" \
  -g "FAIL,XFAIL,BORK,WARN,SKIP" \
  -p "$TEST_PHP_EXECUTABLE" \
  -n \
  --offline \
  --show-diff \
  --set-timeout 120
