/* scanner.h
 *
 * This file is part of the Zephir Parser.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

#ifndef PHP_ZEPHIR_SCANNER_H
#define PHP_ZEPHIR_SCANNER_H

#define XX_SCANNER_RETCODE_EOF -1
#define XX_SCANNER_RETCODE_ERR -2
#define XX_SCANNER_RETCODE_IMPOSSIBLE -3

/** Modes */
#define XX_T_IGNORE 297

/* Literals & Identifiers */
#define XX_T_INTEGER 301
#define XX_T_DOUBLE 302
#define XX_T_STRING 303
#define XX_T_NULL 304
#define XX_T_FALSE 305
#define XX_T_TRUE 306
#define XX_T_IDENTIFIER 307
#define XX_T_ARRAY 308
#define XX_T_CHAR 309
#define XX_T_ISTRING 310

#define XX_T_TYPE_INTEGER 320
#define XX_T_TYPE_DOUBLE 321
#define XX_T_TYPE_BOOL 322
#define XX_T_TYPE_STRING 323
#define XX_T_TYPE_VAR 324
#define XX_T_TYPE_LONG 325
#define XX_T_TYPE_ULONG 326
#define XX_T_TYPE_CHAR 327
#define XX_T_TYPE_UCHAR 328
#define XX_T_TYPE_UINTEGER 329
#define XX_T_TYPE_ARRAY 330
#define XX_T_TYPE_CALLABLE 331
#define XX_T_TYPE_OBJECT 332
#define XX_T_TYPE_RESOURCE 333
#define XX_T_TYPE_NULL 334
#define XX_T_TYPE_THIS 335
#define XX_T_TYPE_MIXED 336
#define XX_T_TYPE_FALSE 337

#define XX_T_NAMESPACE 350
#define XX_T_CLASS 351
#define XX_T_PUBLIC 352
#define XX_T_PROTECTED 353
#define XX_T_EXTENDS 354
#define XX_T_FUNCTION 355
#define XX_T_LET 356
#define XX_T_COMMENT 357
#define XX_T_ECHO 358
#define XX_T_CONST 359
#define XX_T_ABSTRACT 360
#define XX_T_IMPLEMENTS 361
#define XX_T_INTERFACE 362
#define XX_T_IF 363
#define XX_T_ELSE 364
#define XX_T_WHILE 365
#define XX_T_NEW 366
#define XX_T_RETURN 367
#define XX_T_LOOP 368
#define XX_T_BREAK 369
#define XX_T_CONTINUE 370
#define XX_T_INSTANCEOF 371
#define XX_T_TYPEOF 372
#define XX_T_ISSET 373
#define XX_T_UNSET 374
#define XX_T_THROW 375
#define XX_T_FOR 376
#define XX_T_IN 377
#define XX_T_FETCH 378
#define XX_T_SWITCH 379
#define XX_T_CASE 380
#define XX_T_DEFAULT 381
#define XX_T_REVERSE 382
#define XX_T_PRIVATE 383
#define XX_T_STATIC 384
#define XX_T_INLINE 385
#define XX_T_FINAL 386
#define XX_T_CONSTANT 387
#define XX_T_DO 388
#define XX_T_REQUIRE 389
#define XX_T_CLONE 390
#define XX_T_EMPTY 391
#define XX_T_VOID 392
#define XX_T_LIKELY 393
#define XX_T_UNLIKELY 394
#define XX_T_USE 395
#define XX_T_AS 396
#define XX_T_TRY 397
#define XX_T_CATCH 398
#define XX_T_DEPRECATED 399
#define XX_T_REQUIRE_ONCE 459
#define XX_T_YIELD 460

/* Operators */
#define XX_T_AT '@'
#define XX_T_DOT '.'
#define XX_T_COMMA ','
#define XX_T_ASSIGN '='
#define XX_T_LESS '<'
#define XX_T_GREATER '>'
#define XX_T_COLON ':'
#define XX_T_DOTCOMMA ';'
#define XX_T_QUESTION '?'
#define XX_T_BRACKET_OPEN '{'
#define XX_T_BRACKET_CLOSE '}'
#define XX_T_SBRACKET_OPEN '['
#define XX_T_SBRACKET_CLOSE ']'
#define XX_T_PARENTHESES_OPEN '('
#define XX_T_PARENTHESES_CLOSE ')'
#define XX_T_BITWISE_OR '|'
#define XX_T_BITWISE_AND '&'
#define XX_T_BITWISE_XOR '^'
#define XX_T_ARROW 400
#define XX_T_EQUALS 401
#define XX_T_IDENTICAL 402
#define XX_T_ADD '+'
#define XX_T_SUB '-'
#define XX_T_MUL '*'
#define XX_T_DIV '/'
#define XX_T_MOD '%'
#define XX_T_INCR 403
#define XX_T_DECR 404
#define XX_T_NOTEQUALS 405
#define XX_T_NOTIDENTICAL 406
#define XX_T_NOT 407
#define XX_T_BITWISE_NOT '~'
#define XX_T_GREATEREQUAL 408
#define XX_T_LESSEQUAL 409
#define XX_T_ASSIGN_ADD 410
#define XX_T_ASSIGN_SUB 411
#define XX_T_ASSIGN_MUL 412
#define XX_T_ASSIGN_DIV 413
#define XX_T_ASSIGN_CONCAT 414
#define XX_T_AND 415
#define XX_T_OR 416
#define XX_T_DOUBLECOLON 417
#define XX_T_ASSIGN_MOD 418
#define XX_T_BITWISE_SHIFTLEFT 419
#define XX_T_BITWISE_SHIFTRIGHT 420
#define XX_T_DOUBLEARROW 440
#define XX_T_INCLUSIVE_RANGE 441
#define XX_T_EXCLUSIVE_RANGE 442

#define XX_T_CBLOCK 451

#define XX_T_ELSEIF 452
#define XX_T_INTERNAL 453

/* assign-bitwise operators */
#define XX_T_ASSIGN_BITWISE_AND           454
#define XX_T_ASSIGN_BITWISE_OR            455
#define XX_T_ASSIGN_BITWISE_XOR           456
#define XX_T_ASSIGN_BITWISE_SHIFTLEFT     457
#define XX_T_ASSIGN_BITWISE_SHIFTRIGHT    458

#endif // PHP_ZEPHIR_SCANNER_H
