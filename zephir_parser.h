/* zephir_parser.h
 *
 * This file is part of the Zephir Parser.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

#ifndef PHP_ZEPHIR_PARSER_H
#define PHP_ZEPHIR_PARSER_H

extern zend_module_entry zephir_parser_module_entry;
#define phpext_zephir_parser_ptr &zephir_parser_module_entry

#define PHP_ZEPHIR_PARSER_NAME "Zephir Parser"
#define PHP_ZEPHIR_PARSER_VERSION "1.4.0"
#define PHP_ZEPHIR_PARSER_AUTHOR "Zephir Team and contributors"
#define PHP_ZEPHIR_PARSER_DESCRIPTION "The Zephir Parser delivered as a C extension for the PHP language."

#ifdef PHP_WIN32
#	define PHP_ZEPHIR_PARSER_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_ZEPHIR_PARSER_API __attribute__ ((visibility("default")))
#else
#	define PHP_ZEPHIR_PARSER_API
#endif

#ifdef ZTS
#include <TSRM.h>
#endif

#define ZEPHIR_PARSER_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(zephir_parser, v)

#if defined(ZTS) && defined(COMPILE_DL_ZEPHIR_PARSER)
ZEND_TSRMLS_CACHE_EXTERN();
#endif

#ifndef TSRMLS_CC
#	define TSRMLS_CC
#endif

#endif
