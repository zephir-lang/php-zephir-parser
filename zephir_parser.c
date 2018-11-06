
/*
 * This file is part of the Zephir Parser.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <php.h>
#include <php_ini.h>
#include <ext/standard/info.h>

#include "zephir_parser.h"

extern void *xx_parse_program(zval *return_value, char *program, size_t program_length, char *file_path, zval *error_msg);

/* {{{ proto array zephir_parse_file(string content, string filepath)
   Parses a file and returning an intermediate array representation */
static PHP_FUNCTION(zephir_parse_file)
{
	size_t filepath_len = 0;
	size_t content_len = 0;
	char *content = NULL;
	char *filepath = NULL;
#if PHP_VERSION_ID >= 70000
	zval error_msg;
	zval ret;
	zval *e = &error_msg;
	zval *r = &ret;
#else
	zval *error_msg;
	zval *e;
	zval *ret;
	zval *r;
#endif

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ss", &content, &content_len, &filepath, &filepath_len) == FAILURE) {
		RETURN_FALSE;
	}

#if PHP_VERSION_ID < 70000
	MAKE_STD_ZVAL(ret);
	MAKE_STD_ZVAL(error_msg);
	e = error_msg;
	r = ret;
#endif
	ZVAL_NULL(e);
	ZVAL_NULL(r);
	xx_parse_program(r, content, content_len, filepath, e);

	if (Z_TYPE_P(e) == IS_ARRAY) {
		zval_ptr_dtor(&ret);
		RETURN_ZVAL(e, 1, 0);
	}

	assert(Z_TYPE_P(r) == IS_ARRAY);
	zval_ptr_dtor(&error_msg);
	RETURN_ZVAL(r, 1, 1);
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

/* {{{ zephir_parser_functions[]
 *
 * Every user visible function must have an entry in zephir_parser_functions[].
 */
static const zend_function_entry zephir_parser_functions[] = {
	PHP_FE(zephir_parse_file,	NULL)
	PHP_FE_END
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
	NULL, /* RINIT */
	NULL, /* RSHUTDOWN */
	PHP_MINFO(zephir_parser),
	PHP_ZEPHIR_PARSER_VERSION,
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

/* implement standard "stub" routine to introduce ourselves to Zend */
#ifdef COMPILE_DL_ZEPHIR_PARSER
#if defined(ZTS) && PHP_VERSION_ID >= 70000
ZEND_TSRMLS_CACHE_DEFINE();
#endif
ZEND_GET_MODULE(zephir_parser)
#endif

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
