#!/usr/bin/env bash
#
# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

$(phpenv which phpize)

# The ltmain.sh which bundled with PHP it's from libtool 1.5.26.
# However, the version of libtool that claims to no longer remove
# ".gcno" profiler information is libtool 2.2.6. The fix is probably
# in later libtool versions as well.
aclocal && libtoolize --copy --force && autoheader && autoconf

./configure \
	--with-php-config=$(phpenv which php-config) \
	--enable-zephir-parser \
	--enable-zephir-parser-debug \
	--enable-coverage \
	CCACHE_DISABLE=1

make -j"$(getconf _NPROCESSORS_ONLN)"
