# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

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

[Unreleased]: https://github.com/phalcon/php-zephir-parser/compare/v1.2.0...HEAD
[1.2.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.2...v1.2.0
[1.1.4]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.3...v1.1.4
[1.1.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.3...v1.1.0
[1.0.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.0...v1.0.1
