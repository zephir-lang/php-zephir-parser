# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## [1.4.0] - 2021-09-18
### Added
- Added support for `mixed` type [#120](https://github.com/phalcon/php-zephir-parser/issues/120)
- Added support for `yield` statement [#118](https://github.com/phalcon/php-zephir-parser/issues/118)

## [1.3.8] - 2021-09-08
### Changed
- Changed CI from AppVeyor to Github Actions [#110](https://github.com/phalcon/php-zephir-parser/issues/110)

## [1.3.7] - 2021-08-13
### Added
- Added support of `require_once` statement [#107](https://github.com/zephir-lang/php-zephir-parser/pull/107)

## [1.3.6] - 2020-12-03
### Added
- Added ability to build extensions with Visual Studio 2019 for PHP 8.x

## [1.3.5] - 2020-11-29
### Added
- Added PHP 8.0 support [phalcon/zephir#2111](https://github.com/phalcon/zephir/issues/2111)

## [1.3.4] - 2020-04-04
### Fixed
- Fixed operator precedence
  [#89](https://github.com/phalcon/php-zephir-parser/issues/89)

## [1.3.3] - 2019-12-10
### Added
- Added PHP 7.4 support

## [1.3.2] - 2019-09-30
### Changed
- Files `parser.c` and `scanner.c` no longer distributed.
  Package maintainer should re-generate they by himself
  [#75](https://github.com/phalcon/php-zephir-parser/pull/75)

### Fixed
- Fixed `return_value` and `this_ptr` naming collision
  [phalcon/zephir#1660](https://github.com/phalcon/zephir/issues/1660)
- Fixed underscore only identifiers to allow more than 4 characters
  [#75](https://github.com/phalcon/php-zephir-parser/pull/75)
- Update LDFLAGS to reduce linker warnings
- Fixed PHP 7.4 support

## [1.3.1] - 2019-05-01
### Fixed
- Fixed `config.m4` to correct install headers

## [1.3.0] - 2019-04-27
### Added
- Added support for "use" keyword in closures
  [phalcon/zephir#1848](https://github.com/phalcon/zephir/issues/1848),
  [phalcon/zephir#888](https://github.com/phalcon/zephir/issues/888)

### Fixed
- Fixed unicode support in the source code
  [#62](https://github.com/phalcon/php-zephir-parser/issues/62),
  [#56](https://github.com/phalcon/php-zephir-parser/issues/56)
- Fixed memory leaks on processing errors

## [1.2.0] - 2019-01-14
### Added
- Added ability to enable `YYDEBUG` on fly by exporting `ZEPHIR_YYDEBUG`
  environment variable with the value of 1
- Added support of PHP 7.3 for Windows (Linux users have this support for a long time)

### Fixed
- Corrected behavior on parse an empty file. Now an empty
  [IR](https://en.wikipedia.org/wiki/Intermediate_representation)
  will be returned as an array
- Fixed language scanner and parser so that it is possible to parse files
  containing empty docblocks or files contains comments only

### Removed
- PHP 5.x no longer supported. PHP 5.x users should use previous releases

## [1.1.4] - 2018-11-22
### Fixed
- Fixed syntax error with final class and use of extends and implements
  [#48](https://github.com/phalcon/php-zephir-parser/issues/48)

## [1.1.3] - 2018-11-06
### Changed
- Extremely simplified installation of the extension using standard PHP workflow
  [#38](https://github.com/phalcon/php-zephir-parser/issues/38)

### Fixed
- Improved error handling and prevent segfault on invalid syntax
  [#30](https://github.com/phalcon/php-zephir-parser/issues/30)

### Removed
- Removed no longer needed BASH scripts to build and install extension

## [1.1.2] - 2018-01-23
### Added
- Added ability to build Windows DLLs for PHP 7.2

### Changed
- Removed ability to build Windows DLLs for PHP 5.x.
  Windows users with PHP 5.x should use Zephir Parser <= 1.1.1 (see latest releases).

## [1.1.1] - 2017-11-09
### Changed
- Improved install scripts
- Refactored tests
- Added re2c check to install script

### Fixed
- Fixed `mod-assign` operator recognition
- Fixed issue with incorrectly used `YYMARKER` and `YYCURSOR`
  [#31](https://github.com/phalcon/php-zephir-parser/issues/31),
  [phalcon/zephir#1591](https://github.com/phalcon/zephir/issues/1591),
  [phalcon/cphalcon#13140](https://github.com/phalcon/cphalcon/issues/13140)
- Improved scanner by removing redundant rules

## [1.1.0] - 2017-10-12
### Added
- Added support syntax assign-bitwise operators
  [#14](https://github.com/phalcon/php-zephir-parser/issues/14),
  [phalcon/zephir#1056](https://github.com/phalcon/zephir/issues/1056)

### Changed
- Refactor tests to use more standard approach usually used for PHP extensions

## [1.0.3] - 2017-05-13
### Added
- Make parser return error message on failure [#19](https://github.com/phalcon/php-zephir-parser/issues/19)
- Added support of `$_ENV` global var [phalcon/zephir#1224](https://github.com/phalcon/zephir/issues/1224)
- Amended tests

### Changed
- Improved installer: use `sudo` only if `make install` fails

### Fixed
- Treat warnings as errors
- Fix memory leak for PHP5

## [1.0.2] - 2017-04-14
### Added
- Added an ability to use parentheses in for loops [#3](https://github.com/phalcon/php-zephir-parser/issues/3)

### Changed
- Improved install script to use specific optimizations for gcc and add ability to install on Gentoo and macOS

### Fixed
- Fixed parser memory leaks [#2](https://github.com/phalcon/php-zephir-parser/issues/2)

## [1.0.1] - 2017-03-31
### Added
- Added script to build development version (Linux)
- Added ability to compile extension for PHP 7 (Windows)
- Added Windows manual (Windows)

### Changed
- Optimize build to produce smaller module
- Improved Win32 build by providing separated `bat` file (Windows)
- Improved build and tests on AppVeyor (Windows)

### Fixed
- Fixed compiler warnings on build lemon
- Removing unused structures
- Removing unused variables

## 1.0.0 - 2017-03-26
### Added
 - Initial stable release

[Unreleased]: https://github.com/phalcon/php-zephir-parser/compare/v1.4.0...HEAD
[1.4.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.8...v1.4.0
[1.3.8]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.7...v1.3.8
[1.3.7]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.6...v1.3.7
[1.3.6]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.5...v1.3.6
[1.3.5]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.4...v1.3.5
[1.3.4]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.3...v1.3.4
[1.3.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.2...v1.3.3
[1.3.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.1...v1.3.2
[1.3.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.4...v1.2.0
[1.1.4]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.3...v1.1.4
[1.1.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.3...v1.1.0
[1.0.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.0...v1.0.1
