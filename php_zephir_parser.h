/*
 +--------------------------------------------------------------------------+
 | Zephir Parser                                                            |
 +--------------------------------------------------------------------------+
 | Copyright (c) 2013-2017 Zephir Team and contributors                     |
 +--------------------------------------------------------------------------+
 | This source file is subject the MIT license, that is bundled with        |
 | this package in the file LICENSE, and is available through the           |
 | world-wide-web at the following url:                                     |
 | https://zephir-lang.com/license.html                                     |
 |                                                                          |
 | If you did not receive a copy of the MIT license and are unable          |
 | to obtain it through the world-wide-web, please send a note to           |
 | license@zephir-lang.com so we can mail you a copy immediately.           |
 +--------------------------------------------------------------------------+
*/

/* $Id$ */

#ifndef PHP_ZEPHIR_PARSER_H
#define PHP_ZEPHIR_PARSER_H

extern zend_module_entry zephir_parser_module_entry;
#define phpext_zephir_parser_ptr &zephir_parser_module_entry

#define PHP_ZEPHIR_PARSER_NAME "Zephir Parser"
#define PHP_ZEPHIR_PARSER_VERSION "1.0.3"
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
#include "TSRM.h"
#endif

#define ZEPHIR_PARSER_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(zephir_parser, v)

#if defined(ZTS) && defined(COMPILE_DL_ZEPHIR_PARSER) && PHP_VERSION_ID >= 70000
ZEND_TSRMLS_CACHE_EXTERN();
#endif

#endif
