# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased] - xxxx-xx-xx
### Added
- Added support for array destructuring assignment syntax `let [a, b, c] = expr;`,
  matching PHP 7.1+ short list convention. Supports skipped slots (`let [a, , c] = arr;`)
  and all-caps variable names. Parser-only; compiler code generation tracked in
  [zephir#2496](https://github.com/zephir-lang/zephir/issues/2496)
  ([#18](https://github.com/zephir-lang/php-zephir-parser/issues/18))
- Added `docs/grammar.ebnf` containing the complete Zephir grammar in EBNF notation
  for railroad diagram visualization via [bottlecaps.de/rr/ui](https://www.bottlecaps.de/rr/ui)
  ([#106](https://github.com/zephir-lang/php-zephir-parser/issues/106))

### Fixed
- All-uppercase identifiers (e.g. `RBF`, `LU`, `A`) are now accepted as class names,
  method names, function names, variable names, property names, and parameters.
  Previously the scanner emitted `XX_T_CONSTANT` for any all-caps token and grammar
  rules for name positions only accepted `XX_T_IDENTIFIER`, causing a syntax error
  ([#39](https://github.com/zephir-lang/php-zephir-parser/issues/39),
  [#180](https://github.com/zephir-lang/php-zephir-parser/pull/180)).
- Class properties, constants, and methods can now be declared in any order inside a
  class body. Previously only 9 fixed orderings were accepted; interleaving them (e.g.
  a constant after a property) caused a `ParseException`
  ([#26](https://github.com/zephir-lang/php-zephir-parser/issues/26),
  [#181](https://github.com/zephir-lang/php-zephir-parser/pull/181)).
- `(uchar)` cast expressions no longer emit `"unknown type"` into the AST. The missing
  `XX_TYPE_UCHAR` case has been added to `xx_ret_type()` in `parser/parser.h`
  ([#82](https://github.com/zephir-lang/php-zephir-parser/issues/82),
  [#182](https://github.com/zephir-lang/php-zephir-parser/pull/182)).
- String literals are now accepted as the method name in dynamic static method calls
  (`self::{"name"}()`, `ClassName::{"method"}(args)`, `static::{"name"}()`). Previously
  only `IDENTIFIER` was accepted in that position while `xx_mcall_expr` already
  supported `STRING`
  ([#22](https://github.com/zephir-lang/php-zephir-parser/issues/22),
  [#183](https://github.com/zephir-lang/php-zephir-parser/pull/183)).
- The `~` (bitwise-NOT) operator no longer conflicts with the `~"…"` interned-string
  literal (ISTRING) token. The re2c longest-match rule always resolved this correctly,
  but the disambiguation is now documented with an explanatory comment in `scanner.re`
  and covered by regression tests
  ([#23](https://github.com/zephir-lang/php-zephir-parser/issues/23),
  [#184](https://github.com/zephir-lang/php-zephir-parser/pull/184)).

## [1.9.0] - 2026-04-02
### Added
- Add support for nested property-access [#169](https://github.com/phalcon/php-zephir-parser/issues/169)

### Changed
- Bump `actions/download-artifact` from v5 → v6 → v7 → v8
  ([#171](https://github.com/zephir-lang/php-zephir-parser/pull/171),
  [#175](https://github.com/zephir-lang/php-zephir-parser/pull/175),
  [#176](https://github.com/zephir-lang/php-zephir-parser/pull/176))
- Bump `actions/upload-artifact` from v4 → v5 → v6 → v7
  ([#172](https://github.com/zephir-lang/php-zephir-parser/pull/172),
  [#174](https://github.com/zephir-lang/php-zephir-parser/pull/174),
  [#177](https://github.com/zephir-lang/php-zephir-parser/pull/177))
- Bump `actions/checkout` from v5 → v6
  ([#173](https://github.com/zephir-lang/php-zephir-parser/pull/173))
- Bump `codecov/codecov-action` from v5 → v6
  ([#178](https://github.com/zephir-lang/php-zephir-parser/pull/178))

## [1.8.0] - 2025-09-28
### Added
- Enabled PHP 8.5 support [#160](https://github.com/phalcon/php-zephir-parser/issues/160)
- Added full support for object variable declaration [#37](https://github.com/phalcon/php-zephir-parser/issues/37)
- Added support for single letter classes [#166](https://github.com/phalcon/php-zephir-parser/issues/166)

## [1.7.0] - 2024-11-23
### Added
- Enabled PHP 8.4 support [#154](https://github.com/phalcon/php-zephir-parser/issues/154)

## [1.6.1] - 2024-06-03
### Fixed
- Fix lcov coverage [#151](https://github.com/phalcon/php-zephir-parser/issues/151)

## [1.6.0] - 2023-08-27
### Added
- Enabled support of PHP8.3 for PECL [#141](https://github.com/phalcon/php-zephir-parser/issues/148)

## [1.5.3] - 2023-02-08
### Added
- Enabled Thread Safe (TS) builds [#145](https://github.com/phalcon/php-zephir-parser/issues/145)

## [1.5.2] - 2022-12-27
### Added
- Enabled support of PHP8.2 for Windows [#141](https://github.com/phalcon/php-zephir-parser/issues/141)

## [1.5.1] - 2022-09-19
### Added
- Enabled support of PHP8.2 for PECL [#141](https://github.com/phalcon/php-zephir-parser/issues/141)

## [1.5.0] - 2022-02-12
### Added
- Added support for `false` return type [#137](https://github.com/phalcon/php-zephir-parser/issues/137)

## [1.4.2] - 2021-12-11
### Added
- Enabled support of PHP8.1 for PECL [#116](https://github.com/phalcon/php-zephir-parser/issues/116)

## [1.4.1] - 2021-09-18
### Changed
- Renamed extension name from `Zephir Parser` to `zephir_parser` [#125](https://github.com/phalcon/php-zephir-parser/issues/125)

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

[Unreleased]: https://github.com/phalcon/php-zephir-parser/compare/v1.9.0...HEAD
[1.9.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.8.0...v1.9.0
[1.8.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.7.0...v1.8.0
[1.7.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.6.1...v1.7.0
[1.6.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.6.0...v1.6.1
[1.6.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.5.3...v1.6.0
[1.5.3]: https://github.com/phalcon/php-zephir-parser/compare/v1.5.2...v1.5.3
[1.5.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.5.1...v1.5.2
[1.5.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.5.0...v1.5.1
[1.5.0]: https://github.com/phalcon/php-zephir-parser/compare/v1.4.2...v1.5.0
[1.4.2]: https://github.com/phalcon/php-zephir-parser/compare/v1.4.1...v1.4.2
[1.4.1]: https://github.com/phalcon/php-zephir-parser/compare/v1.4.0...v1.4.1
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
