OUTCOV=coverage.info
DIRCOV=coverage

.PHONY: clean-coverage
clean-coverage:
	-rm -fr $(OUTCOV) $(DIRCOV)

# coverage-initial test coverage-capture
.PHONY: coverage-initial
coverage-initial: clean-coverage
	@$(LCOV) --directory ./parser --directory . --zerocounters
	@$(LCOV) --directory ./parser --directory . --capture --compat-libtool --initial --base-directory=. --output-file $(OUTCOV)

.PHONY: coverage-capture
coverage-capture:
	@$(LCOV) --no-checksum --directory . --capture --compat-libtool --output-file $(OUTCOV)
	@$(LCOV) --remove $(OUTCOV) "/usr*" --remove $(OUTCOV) "${HOME}/.phpenv/*" --compat-libtool --output-file $(OUTCOV)

.PHONY: coverage-html
coverage-html: coverage-capture
	@$(GENHTML) --legend --output-directory $(DIRCOV) --title "Zephir Parser code coverage" $(OUTCOV)
