/* This file is part of the Zephir Parser.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

#ifndef PHP_ZEPHIR_XX_H
#define PHP_ZEPHIR_XX_H 1

// to pull in the definition for zval
#include <Zend/zend_types.h>

/* List of tokens and their names */
typedef struct _xx_token_names {
	unsigned int code;
	char *name;
} xx_token_names;

/* Contains all state for a single scan session.
 *
 * This structure is used by a scanner to preserve its state.
 *
 * TODO: Make all charptrs declared as const to help ensure that you don't
 * accidentally end up modifying the buffer as it's being scanned. This means
 * that any time you want to read data into the buffer, you need to cast the
 * pointers to be nonconst.
 */
typedef struct _xx_scanner_state {
	/* The current character being looked at by the scanner.
	 * This is the same as re2c's YYCURSOR. */
	char *cursor;

	/* The last (uppermost) valid character in the current buffer.
	 * This is the same as re2c's YYLIMIT. */
	char *limit;

	/* Used internally by re2c engine to handle backtracking.
	 * This is the same as re2c's YYMARKER. */
	char *marker;

	int active_token;
	unsigned int start_length;
	int mode;
	unsigned int active_line;
	unsigned int active_char;
	unsigned int class_line;
	unsigned int class_char;
	unsigned int method_line;
	unsigned int method_char;
	char *active_file;
} xx_scanner_state;

/* Extra information tokens */
typedef struct _xx_scanner_token {
	int opcode;
	char *value;
	int len;
} xx_scanner_token;

typedef struct _xx_parser_token {
	int opcode;
	char *token;
	int token_len;
	int free_flag;
} xx_parser_token;

typedef struct _xx_parser_status {
	int status;
	zval ret;
	xx_scanner_state *scanner_state;
	xx_scanner_token *token;
	char *syntax_error;
	unsigned int syntax_error_len;
	unsigned int number_brackets;
} xx_parser_status;

#define XX_PARSING_OK 1
#define XX_PARSING_FAILED 0

void parser_track_variable(xx_scanner_state *state, zval **var);
int parser_is_tracked(xx_scanner_state *state, zval **var);
void parser_free_variable(xx_scanner_state *state, zval **var);
int xx_get_token(xx_scanner_state *state, xx_scanner_token *token);

#endif
