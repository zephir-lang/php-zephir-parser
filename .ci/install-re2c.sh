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

# From https://stackoverflow.com/a/4025065
vercomp () {
    if [[ $1 == $2 ]]
    then
        return 0
    fi
    local IFS=.
    local i ver1=($1) ver2=($2)
    # fill empty fields in ver1 with zeros
    for ((i=${#ver1[@]}; i<${#ver2[@]}; i++))
    do
        ver1[i]=0
    done
    for ((i=0; i<${#ver1[@]}; i++))
    do
        if [[ -z ${ver2[i]} ]]
        then
            # fill empty fields in ver2 with zeros
            ver2[i]=0
        fi
        if ((10#${ver1[i]} > 10#${ver2[i]}))
        then
            return 1
        fi
        if ((10#${ver1[i]} < 10#${ver2[i]}))
        then
            return 2
        fi
    done
    return 0
}

ext='tar.xz'
vercomp "$RE2C_VERSION" '1.2'

case $? in
  2) ext='tar.gz';;
esac

pkgname=re2c
source="https://github.com/skvadrik/${pkgname}/releases/download/${RE2C_VERSION}/${pkgname}-${RE2C_VERSION}.${ext}"
downloadfile="${pkgname}-${RE2C_VERSION}.${ext}"
prefix="${HOME}/.local/opt/${pkgname}/${pkgname}-${RE2C_VERSION}"
bindir="${prefix}/bin"

if [ ! -f "$bindir/re2c" ]; then
  if [ ! -d "$(dirname "$HOME/.cache/$pkgname")" ]; then
    mkdir -p "$(dirname "$HOME/.cache/$pkgname")"
  fi

  cd "$(dirname "$HOME/.cache/$pkgname")" || exit 1

  if [ ! -f "$downloadfile" ]; then
    echo "curl -sSL --fail-early '$source' -o '${pkgname}-${RE2C_VERSION}.${ext}'"
    curl -sSL --fail-early "$source" -o "${pkgname}-${RE2C_VERSION}.${ext}"
  fi

  if [ ! -f "$downloadfile" ]; then
    >&2 echo "Unable to locate $downloadfile file. Abort..."
    exit 1
  else
    file "$downloadfile"
  fi

  tar -xf "$downloadfile" || exit 1

  if [ ! -d "${pkgname}-${RE2C_VERSION}" ]; then
    >&2 echo "Unable to locate re2c source files. Abort..."
    exit 1
  fi

  if [ ! -d "$prefix" ]; then
    mkdir -p "$prefix"
  fi

  cd "${pkgname}-${RE2C_VERSION}" || exit 1
  ./configure --prefix="$prefix"

  make -j"$(getconf _NPROCESSORS_ONLN)"
  make install
fi

if [ ! -x "$bindir/re2c" ]; then
  >&2 echo "Unable to locate re2c executable. Abort..."
  exit 1
fi

mkdir -p "$HOME/bin"
ln -s "$bindir/re2c" "$HOME/bin/re2c"

re2c --version
exit 0
