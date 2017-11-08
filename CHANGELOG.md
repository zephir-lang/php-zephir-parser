# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Changed
- Improved install scripts
- Refactored tests

### Fixed
- Fixed `mod-assign` operator recognition
- Fixed issue with incorrectly used YYMARKER and YYCURSOR [#31](https://github.com/phalcon/php-zephir-parser/issues/31),
[phalcon/zephir#1591](https://github.com/phalcon/zephir/issues/1591), [phalcon/cphalcon#13140](https://github.com/phalcon/cphalcon/issues/13140)
- Improved scanner by removing reundant rules

## [1.1.0] - 2017-10-12
### Added
- Added support syntax assign-bitwise operators [#14](https://github.com/phalcon/php-zephir-parser/issues/14),
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
- Improved Win32 build by providing separated `bat` file  (Windows)
- Improved build and tests on Appveyor  (Windows)

### Fixed
- Fixed compiler warnings on build lemon
- Removing unused structures
- Removing unused variables

## 1.0.0 - 2017-03-26
### Added
 - Initial stable release

[Unreleased]: https://github.com/phalcon/php-zephir-parser/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.3...v1.1.0
[1.0.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.0.0...v1.0.1
