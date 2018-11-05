ifeq ($(PHP_EXECUTABLE),)
$(error ERROR: Cannot run build without CLI sapi.)
endif

RE2C_FLAGS=
RE2C_VERSION=$(shell $(RE2C) --vernum 2>/dev/null)
ifeq ($(shell test "$(RE2C_VERSION)" -gt "9999"; echo $$?),0)
RE2C_FLAGS=-W
endif

PHP_MAJOR_VERSION=$(shell $(PHP_EXECUTABLE) -r 'echo PHP_MAJOR_VERSION;')

clean: clean-check

.PHONY: clean-check
clean-check:
	find . -name \*.loT -o -name \*.out | xargs rm -f
	find . -name \*.tmp | xargs rm -f

.PHONY: maintainer-clean
maintainer-clean:
	@echo 'This command is intended for maintainers to use; it'
	@echo 'deletes files that may need special tools to rebuild.'
	@echo
	-rm -f $(srcdir)/parser/lemon
	-rm -f $(srcdir)/parser/scanner.c
	-rm -f $(srcdir)/parser/parser.c
	-rm -f $(srcdir)/parser/parser.php5.c
	-rm -f $(srcdir)/parser/parser.php7.c
	-rm -f $(srcdir)/parser/parser.php5.h
	-rm -f $(srcdir)/parser/parser.php7.h

$(srcdir)/parser/scanner.c: $(srcdir)/parser/scanner.re
	$(RE2C) $(RE2C_FLAGS) --no-generation-date -o $@ $<
	$(SED) s/"#line \([[:digit:]]\+\) \(.*\)\(\/parser\/\)\(.*\)\""/"\/\/line \1 .\3\4"/g $@ > $@.tmp && mv -f $@.tmp $@

$(srcdir)/parser/lemon: $(srcdir)/parser/lemon.c
	$(CC) $< -o $@

$(srcdir)/parser/parser.c: $(srcdir)/parser/parser.php$(PHP_MAJOR_VERSION).c $(srcdir)/parser/base.c
	@echo "#include <php.h>" > $@
	cat $< >> $@
	cat $(top_srcdir)/parser/base.c >> $@
	$(SED) s/"#line \([[:digit:]]\+\) \(.*\)\(\/parser\/\)\(.*\)\""/"\/\/line \1 .\3\4"/g $@ > $@.tmp && mv -f $@.tmp $@

$(srcdir)/parser/parser.php$(PHP_MAJOR_VERSION).c: $(srcdir)/parser/parser.php$(PHP_MAJOR_VERSION).lemon $(srcdir)/parser/lemon
	$(top_srcdir)/parser/lemon $<

