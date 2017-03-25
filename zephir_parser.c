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

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_zephir_parser.h"

extern void *xx_parse_program(zval *return_value, char *program, size_t program_length, char *file_path, zval **error_msg);

/* {{{ proto array zephir_parse_file(string content, string filepath)
   Parses a file and returning an intermediate array representation */
PHP_FUNCTION(zephir_parse_file)
{
	size_t filepath_len = 0;
	size_t content_len = 0;
	char *content = NULL;
	char *filepath = NULL;
#if PHP_VERSION_ID >= 70000
	zend_array *arr = NULL;
    zval ret;
    zval error, *error_ptr = &error;
    zval **error_msg = &error_ptr;
    ZVAL_UNDEF(error_ptr);
#else
	zval *ret = NULL;
	zval **error_msg = NULL;
#endif

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ss", &content, &content_len, &filepath, &filepath_len) == FAILURE) {
		return;
	}

#if PHP_VERSION_ID >= 70000
	xx_parse_program(&ret, content, content_len, filepath, error_msg);
#else
	MAKE_STD_ZVAL(ret);
	xx_parse_program(ret, content, content_len, filepath, error_msg);
#endif

#if PHP_VERSION_ID >= 70000
	if (Z_TYPE_P(error_ptr) != IS_UNDEF) {
        RETURN_ZVAL(error_ptr, 1, 1);
    }
    RETURN_ZVAL(&ret, 1, 1);
#else
	RETVAL_ZVAL(ret, 1, 0);
#endif
}
/* }}} */

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(zephir_parser)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(zephir_parser)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(zephir_parser)
{
	php_info_print_box_start(0);
	php_printf("%s", PHP_ZEPHIR_PARSER_DESCRIPTION);
	php_info_print_box_end();

	php_info_print_table_start();
	php_info_print_table_header(2, PHP_ZEPHIR_PARSER_NAME, "enabled");
	php_info_print_table_row(2, "Author", PHP_ZEPHIR_PARSER_AUTHOR);
	php_info_print_table_row(2, "Version", PHP_ZEPHIR_PARSER_VERSION);
	php_info_print_table_row(2, "Build Date", __DATE__ " " __TIME__);
	php_info_print_table_end();
}
/* }}} */

/* {{{ zephir_parser_functions[] */
const zend_function_entry zephir_parser_functions[] = {
		PHP_FE(zephir_parse_file,	NULL)		/* For testing, remove later. */
		PHP_FE_END	/* Must be the last line in zephir_parser_functions[] */
};
/* }}} */

/* {{{ zephir_parser_module_entry
 */
zend_module_entry zephir_parser_module_entry = {
		STANDARD_MODULE_HEADER,
		PHP_ZEPHIR_PARSER_NAME,
		zephir_parser_functions,
		PHP_MINIT(zephir_parser),
		PHP_MSHUTDOWN(zephir_parser),
		NULL,
		NULL,
		PHP_MINFO(zephir_parser),
		PHP_ZEPHIR_PARSER_VERSION,
		STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_ZEPHIR_PARSER
#ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE();
#endif
ZEND_GET_MODULE(zephir_parser)
#endif
