# Zephir Parser

[![Build Status](https://travis-ci.org/phalcon/php-zephir-parser.svg?branch=master)](https://travis-ci.org/phalcon/php-zephir-parser)

The Zephir Parser delivered as a C extension for the PHP language.

## Get Started

### Linux

On a Unix-based platform you can easily compile and install the extension from sources.

**Requirements**

Prerequisite packages are:

* GCC/Clang compiler (Linux/Solaris/FreeBSD) or Xcode (MacOS)
* [`re2c`](http://re2c.org/) >= 0.13

#### Ubuntu

```bash
sudo apt-get install php7.0-dev gcc make re2c
```

#### Suse

```bash
sudo zypper install php7.0-devel gcc make re2c
```

### CentOS/Fedora/RHEL

```bash
sudo yum install php-devel gcc make re2c
```

## General Compilation

Follow these instructions to generate a binary extension for your platform:

```bash
git clone git://github.com/phalcon/php-zephir-parser.git
cd php-zephir-parser
bash ./build-linux

make -j"$(getconf _NPROCESSORS_ONLN)"
sudo make install
```

Add the extension to your php.ini:

```ini
extension=zephir_parser.so
```

Finally, restart the web server.

## Usage

```php
$path   = __DIR__ . '/test.zep';
$retval = zephir_parse_file(file_get_contents($path), $path);

echo PHP_EOL;
var_export($retval);
echo PHP_EOL;
```

## License

Zephir Parser is open source software licensed under the MIT License. See the LICENSE file for more
