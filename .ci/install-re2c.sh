#!/usr/bin/env bash
#
# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

if [ -z ${RE2C_VERSION+x} ]; then
  >&2 echo "The RE2C_VERSION value is not set. Stop."
  exit 1
fi

if [ "${RE2C_VERSION}" == "system" ]; then
  echo "Use system re2c. Skip."
  exit 0
fi

pkgname=re2c
source="https://github.com/skvadrik/${pkgname}/releases/download/${RE2C_VERSION}/${pkgname}-${RE2C_VERSION}.tar.xz"
downloaddir="${HOME}/.cache/${pkgname}/${pkgname}-${RE2C_VERSION}"
prefix="${HOME}/.local/opt/${pkgname}/${pkgname}-${RE2C_VERSION}"
bindir="${prefix}/bin"

if [ ! -f "${bindir}/re2c" ]; then
  if [ ! -d `dirname ${downloaddir}` ]; then
    mkdir -p `dirname ${downloaddir}`
  fi
  cd "$(dirname "$downloaddir")" || exit 1

  if [ ! -f "${pkgname}-${RE2C_VERSION}.tar.xz" ]; then
    curl -sSL "$source" -o "${pkgname}-${RE2C_VERSION}.tar.xz"
  fi

  if [ ! -f "${pkgname}-${RE2C_VERSION}.tar.xz" ]; then
    >&2 echo "Unable to locate ${pkgname}-${RE2C_VERSION}.tar.xz file. Stop."
    exit 1
  fi

  if [ ! -d "${downloaddir}" ]; then
    mkdir -p "${downloaddir}"
    tar -xf "${pkgname}-${RE2C_VERSION}.tar.xz" || exit 1
  fi

  if [ ! -d "${downloaddir}" ]; then
    >&2 echo "Unable to locate re2c source. Stop."
    exit 1
  fi

  if [ ! -d "${prefix}" ]; then
    mkdir -p "${prefix}"
  fi

  cd "${downloaddir}" || exit 1
  ./configure --prefix="${prefix}"

  make -j"$(getconf _NPROCESSORS_ONLN)"
  make install
fi

if [ ! -x "${bindir}/re2c" ]; then
  >&2 echo "Unable to locate re2c executable. Stop."
  exit 1
fi

mkdir -p "${HOME}/bin"
ln -s "${bindir}/re2c" "${HOME}/bin/re2c"

re2c --version
exit 0
