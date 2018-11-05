OUTCOV=coverage.info
DIRCOV=coverage

clean-coverage:
	-rm -fr $(OUTCOV) $(DIRCOV)

coverage-initial: clean-coverage
	@echo "Capture initial zero coverage data"
	@$(LCOV) --directory ./parser --directory . --zerocounters
	@$(LCOV) --directory ./parser --directory . --capture --compat-libtool --initial --base-directory=. --output-file $(OUTCOV)

coverage-capture:
	@echo "Generating $@"
	@$(LCOV) --no-checksum --directory ./parser --directory . --capture --compat-libtool --output-file $(OUTCOV)
	@$(LCOV) --remove $(OUTCOV) "/usr*" --remove $(OUTCOV) "${HOME}/.phpenv/*" --remove $(OUTCOV) "${HOME}/build/include/*" --compat-libtool --output-file $(OUTCOV)

coverage-html: coverage-capture
	@$(GENHTML) --legend --output-directory $(DIRCOV) --title "Zephir Parser code coverage" $(OUTCOV)
