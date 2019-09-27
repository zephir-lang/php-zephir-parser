# Contributing to Zephir Parser

Zephir Parser is an open source project and a volunteer effort. Zephir Parser welcomes contribution from everyone.
Please take a moment to review this document in order to make the contribution process easy and effective for everyone
involved.

Following these guidelines helps to communicate that you respect the time of the developers managing and developing this
open source project. In return, they should reciprocate that respect in addressing your issue or assessing patches and
features.

## Contributions

Contributions to Zephir Parser should be made in the form of [GitHub pull requests][pr].
Each pull request will be reviewed by a core contributor (someone with permission to land patches) and either landed in
the main tree or given feedback for changes that would be required before it can be merged. All contributions should
follow this format, even those from core contributors.

## Questions & Support

*We only accept bug reports, new feature requests and pull requests in GitHub*.
For questions regarding the usage of the Zephir Parser or support requests please visit the
[official forums][forum].

## Bug Report Checklist

- Make sure you are using the latest released version of Zephir Parser before submitting a bug report.
  Bugs in versions older than the latest released one will not be addressed by the core team

- If you have found a bug it is important to add relevant reproducibility information to your issue to allow us
  to reproduce the bug and fix it quicker. Add a script, small program or repository providing the necessary code to
  make everyone reproduce the issue reported easily. If a bug cannot be reproduced by the development it would be
  difficult provide corrections and solutions. [Submit Reproducible Test][srt] for more information

- Be sure that information such as OS, Zephir Parser versions and PHP version are part of the bug report

- If you're submitting a Segmentation Fault error, we would require a backtrace, please see [Generating a Backtrace][gb]

## Pull Request Checklist

- Don't submit your pull requests to the `master` branch. Branch from the required branch and,
  if needed, rebase to the proper branch before submitting your pull request.
  If it doesn't merge cleanly with master you may be asked to rebase your changes

- Don't put submodule updates, composer.lock, etc in your pull request unless they are to landed commits

- Make sure that the code you write fits with the general style and coding standards

## Getting Support

If you have a question about how to use Zephir Parser, please see the [support page][support].

## Requesting Features

If you have a change or new feature in mind, please fill an New Featire Request (NFR).

Thanks! <br />
Zephir Team

[pr]: https://help.github.com/articles/using-pull-requests/
[forum]: https://forum.zephir-lang.com
[gb]: https://docs.phalcon.io/en/latest/generating-backtrace
[support]: https://phalcon.io/support
