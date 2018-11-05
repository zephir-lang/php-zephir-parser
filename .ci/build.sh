#!/usr/bin/env bash
#
# This file is part of the Zephir Parser.
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

$(phpenv which phpize)

# The ltmain.sh which bundled with PHP it's from libtool 1.5.26.
# However, the version of libtool that claims to no longer remove
# ".gcno" profiler information is libtool 2.2.6. The fix is probably
# in later libtool versions as well.
aclocal && libtoolize --copy --force && autoheader && autoconf

./configure \
	--with-php-config=$(phpenv which php-config) \
	--enable-zephir_parser \
	CFLAGS="--coverage -fprofile-arcs -ftest-coverage ${CFLAGS}" \
	LDFLAGS="--coverage"

make -j"$(getconf _NPROCESSORS_ONLN)"
