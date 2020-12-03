# Zephir Parser

[![Actions Status][actions badge]][actions link]
[![Build on Windows][:badge-appveyor:]][:build-appveyor:]
[![Coverage Status][:badge-codecov:]][:build-codecov:]
[![License][:badge-license:]][:ext-license:]

The Zephir Parser delivered as a C extension for the PHP language.

Supported PHP versions: **7.0**, **7.1**, **7.2**, **7.3**,  **7.4** and **8.0**

**NOTE:** The [`development`][:dev-branch:]
branch will always contain the latest **unstable** version. If you wish to
check older versions or formal, tagged release, please switch to the
relevant [branch][:branches:]/[tag][:tags:].

## Get Started

**Build Requirements**

Prerequisite packages are:

* OS: Linux || Solaris || FreeBSD || macOS || Windows
* Compiler: `g++` >= 4.4 || `clang++` >= 3.x || `vc++` >= 11
* [`re2c`][:re2c:] >= 0.13.6

To build extension from the source you will need the PHP development headers.
If PHP was manually installed, these should be available by default.
Otherwise, you will need to fetch them from a repository.

### Windows

To install Zephir Parser on Windows:

1. Download [Zephir Parser for Windows][:latest-release:]
2. Extract the DLL file and copy it to your PHP extensions directory
3. Edit your `php.ini` file and add this line:
   ```ini
   [Zephir Parser]
   extension=php_zephir_parser.dll
   ```

### Linux

On a Linux/Unix-based platform you can easily compile and install the
extension from sources.

For Linux/Unix-based based systems you'll need also:

* [GNU make][:gnu-make:] 3.81 or later
* [autoconf][:gnu-autoconf:] 2.31 or later
* [automake][:gnu-automake:] 1.14 or later

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

If you have multiple/specific PHP versions installed, you may be able to specify for which installation you'd like to
build by using the `--with-php-config` option during configuration. For example:

```bash
git clone git://github.com/phalcon/php-zephir-parser.git
cd php-zephir-parser
/usr/local/bin/phpize
./configure --with-php-config=/usr/local/bin/php-config
make
sudo make install
```

Add the extension to your `php.ini`:

```ini
[Zephir Parser]
extension=zephir_parser.so
```

## Usage

```php
$program = <<<EOF
namespace Acme;

class Greeting
{
    public static function sayHello() -> void
    {
        echo "Hello, World!";
    }
}
EOF;

$retval = zephir_parse_file($program, '(eval code)');

var_dump($retval);
```

## Sponsors

Become a sponsor and get your logo on our README on Github with a link to your site.
[[Become a sponsor](https://opencollective.com/phalcon#sponsor)]

<a href="https://opencollective.com/phalcon/#contributors">
<img src="https://opencollective.com/phalcon/tiers/sponsors.svg?avatarHeight=48&width=800" alt="">
</a>

## Backers

Support us with a monthly donation and help us continue our activities.
[[Become a backer](https://opencollective.com/phalcon#backer)]

<a href="https://opencollective.com/phalcon/#contributors">
<img src="https://opencollective.com/phalcon/tiers/backers.svg?avatarHeight=48&width=800&height=200" alt="">
</a>

## License

Zephir Parser is open source software licensed under the MIT License (MIT).
See the [LICENSE][:ext-license:] file for more information.

[actions link]: https://github.com/phalcon/php-zephir-parser/actions
[actions badge]: https://github.com/phalcon/php-zephir-parser/workflows/build/badge.svg

[:badge-appveyor:]: https://ci.appveyor.com/api/projects/status/r4k8baw1iy54v2wt/branch/development?svg=true
[:badge-codecov:]: https://codecov.io/gh/phalcon/php-zephir-parser/branch/development/graph/badge.svg
[:badge-license:]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[:build-appveyor:]: https://ci.appveyor.com/project/sergeyklay/php-zephir-parser/branch/master
[:build-codecov:]: https://codecov.io/gh/phalcon/php-zephir-parser
[:ext-license:]: https://github.com/phalcon/php-zephir-parser/blob/master/LICENSE
[:latest-release:]: https://github.com/phalcon/php-zephir-parser/releases/latest
[:dev-branch:]:https://github.com/phalcon/php-zephir-parser/tree/development
[:branches:]: https://github.com/phalcon/php-zephir-parser/branches
[:tags:]: https://github.com/phalcon/php-zephir-parser/tags
[:re2c:]: http://re2c.org
[:gnu-make:]: https://www.gnu.org/software/make
[:gnu-autoconf:]: https://www.gnu.org/software/autoconf/autoconf.html
[:gnu-automake:]: https://www.gnu.org/software/automake
