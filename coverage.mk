LCOV_REPORT=lcov.info
DIRCOV=coverage

.PHONY: clean-coverage
clean-coverage:
	-rm -fr $(DIRCOV)
	-rm -f $(LCOV_REPORT)

.PHONY: coverage-initial
coverage-initial: clean-coverage
	@$(LCOV) -d . -z
	@$(LCOV) -d . -c --compat-libtool -i -o $(LCOV_REPORT)

.PHONY: coverage-capture
coverage-capture:
	@$(LCOV) --no-checksum -d . -c --compat-libtool -o $(LCOV_REPORT)
	@$(LCOV) --ignore-errors unused -r $(LCOV_REPORT) "/usr*" -r $(LCOV_REPORT) "${HOME}/.phpenv/*" --compat-libtool -o $(LCOV_REPORT)

.PHONY: coverage-html
coverage-html: coverage-capture
	@$(GENHTML) --legend -o $(DIRCOV) -t "Zephir Parser code coverage" $(LCOV_REPORT)
