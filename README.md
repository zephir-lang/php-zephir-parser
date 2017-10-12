# Zephir Parser

[![Build on Linux](https://travis-ci.org/phalcon/php-zephir-parser.svg?branch=master)](https://travis-ci.org/phalcon/php-zephir-parser)
[![Build on Windows](https://ci.appveyor.com/api/projects/status/r4k8baw1iy54v2wt/branch/master?svg=true)](https://ci.appveyor.com/project/sergeyklay/php-zephir-parser/branch/master)

The Zephir Parser delivered as a C extension for the PHP language.

Supported PHP versions: **5.5**, **5.6**, **7.0**, **7.1**, **7.2**

**NOTE:** The `development` branch will always contain the latest **unstable** version.
If you wish to check older versions or formal, tagged release, please switch to the relevant
[branch](https://github.com/phalcon/php-zephir-parser/branches)/[tag](https://github.com/phalcon/php-zephir-parser/tags).

## Get Started

### Windows

To install Zephir Parser on Windows:

1. Download [Zephir Parser for Windows](https://github.com/phalcon/php-zephir-parser/releases/latest)
2. Extract the DLL file and copy it to your PHP extensions directory
3. Edit your php.ini file and add this line:
   ```ini
   [Zephir Parser]
   extension=zephir_parser.dll
   ```
4. Finally, restart your web server

**NOTE:** Also you can [compile it yourself](https://github.com/phalcon/php-zephir-parser/blob/master/README.WIN32-BUILD-SYSTEM).

### Linux

On a Unix-based platform you can easily compile and install the extension from sources.

**Requirements**

Prerequisite packages are:

* OS: Linux || Solaris || FreeBSD || macOS || Windows
* Compiller: `g++` >= 4.4 || `clang++` >= 3.x || `vc++` >= 11
* [`re2c`](http://re2c.org/) >= 0.13

#### Ubuntu

```bash
sudo apt-get install php7.0-dev gcc make re2c autoconf
```

#### Suse

```bash
sudo zypper install php7.0-devel gcc make re2c autoconf
```

### CentOS/Fedora/RHEL

```bash
sudo yum install php-devel gcc make re2c autoconf
```

## General Compilation

Follow these instructions to generate a binary extension for your platform:

```bash
git clone git://github.com/phalcon/php-zephir-parser.git
cd php-zephir-parser
sudo ./install
```

Add the extension to your php.ini:

```ini
[Zephir Parser]
extension=zephir_parser.so
```

Finally, **restart the web server**.

## Advanced compilation

If you have specific php versions running (for example 7.2):

```bash
sudo ./install  --phpize /usr/bin/phpize7.2 --php-config /usr/bin/php-config7.2
```

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
