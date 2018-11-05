# Zephir Parser

[![Build on Linux][:badge-travis:]][:build-travis:]
[![Build status][:badge-appveyor:]][:build-appveyor:]
[![Coverage Status][:badge-codecov:]][:build-codecov:]
[![License][:badge-license:]][:ext-license:]

The Zephir Parser delivered as a C extension for the PHP language.

Supported PHP versions: **5.5**, **5.6**, **7.0**, **7.1**, **7.2**.
Support for PHP 5.x is provided on a best-effort basis and will be removed
in near future.

**NOTE:** The [`development`](https://github.com/phalcon/php-zephir-parser/tree/development)
branch will always contain the latest **unstable** version. If you wish to
check older versions or formal, tagged release, please switch to the
relevant [branch](https://github.com/phalcon/php-zephir-parser/branches)/[tag](https://github.com/phalcon/php-zephir-parser/tags).

## Get Started

**Requirements**

Prerequisite packages are:

* OS: Linux || Solaris || FreeBSD || macOS || Windows
* Compiler: `g++` >= 4.4 || `clang++` >= 3.x || `vc++` >= 11
* [`re2c`](http://re2c.org/) >= 0.13.6

To build extension from the source you will need the PHP development headers.
If PHP was manually installed, these should be available by default.
Otherwise, you will need to fetch them from a repository.

### Windows

**NOTE:** Since version 1.1.2, DLLs are no longer provided for PHP 5.x.
Windows users with PHP 5.x should use Zephir Parser <= 1.1.1.

To install Zephir Parser on Windows:

1. Download [Zephir Parser for Windows](https://github.com/phalcon/php-zephir-parser/releases/latest)
2. Extract the DLL file and copy it to your PHP extensions directory
3. Edit your php.ini file and add this line:
   ```ini
   [Zephir Parser]
   extension=php_zephir_parser.dll
   ```
4. Finally, restart your web server

**NOTE:** Also you can compile Zephir Parser yourself.
For more see: [README.WIN32-BUILD-SYSTEM](./README.WIN32-BUILD-SYSTEM).

### Linux

On a Linux/Unix-based platform you can easily compile and install the
extension from sources.

For Linux/Unix-based based systems you'll need also:

* [GNU make](https://www.gnu.org/software/make/) 3.81 or later
* [autoconf](https://www.gnu.org/software/autoconf/autoconf.html) 2.31 or later
* [automake](https://www.gnu.org/software/automake/) 1.14 or later

#### Ubuntu

```bash
sudo apt-get install php7.0-dev gcc make re2c autoconf automake
```

#### Suse

```bash
sudo zypper install php7.0-devel gcc make re2c autoconf automake
```

### CentOS/Fedora/RHEL

```bash
sudo yum install php-devel gcc make re2c autoconf automake
```

## General Compilation

Follow these instructions to generate a binary extension for your platform:

```bash
git clone git://github.com/phalcon/php-zephir-parser.git
cd php-zephir-parser
phpize
./configure
make
sudo make install
```

If you have specific PHP versions running:

```bash
git clone git://github.com/phalcon/php-zephir-parser.git
cd php-zephir-parser
phpize
./configure --with-php-config=/usr/local/bin/php-config
make
sudo make install
```

Add the extension to your php.ini:

```ini
[Zephir Parser]
extension=zephir_parser.so
```

Finally, **restart the web server**.

## Usage

```php
$path   = __DIR__ . '/test.zep';
$retval = zephir_parse_file(file_get_contents($path), $path);

echo PHP_EOL;
var_export($retval);
echo PHP_EOL;
```

## License

This project is open source software licensed under the MIT License.
See the [LICENSE][:ext-license:] file for more information.

[:badge-travis:]: https://travis-ci.org/phalcon/php-zephir-parser.svg?branch=development
[:badge-appveyor:]: https://ci.appveyor.com/api/projects/status/r4k8baw1iy54v2wt/branch/development?svg=true
[:badge-codecov:]: https://codecov.io/gh/phalcon/php-zephir-parser/branch/developent/graph/badge.svg
[:badge-license:]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[:build-travis:]: https://travis-ci.org/phalcon/php-zephir-parser
[:build-appveyor:]: https://ci.appveyor.com/project/sergeyklay/php-zephir-parser/branch/master
[:build-codecov:]: https://codecov.io/gh/phalcon/php-zephir-parser
[:ext-license:]: https://github.com/phalcon/php-zephir-parser/blob/master/LICENSE
