# Contributing to LaravelPH's website

Looking to contribute something to LaravelPH's website? **Here's how you can help.**

Please take a moment to review this document in order to make the contribution
process easy and effective for everyone involved.

Following these guidelines helps to communicate that you respect the time of
the developers managing and developing this open source project. In return,
they should reciprocate that respect in addressing your issue or assessing
patches and features.


## Feature requests

Feature requests are welcome. But take a moment to find out whether your idea
fits with the scope and aims of the project. It's up to *you* to make a strong
case to convince the project's developers of the merits of this feature. Please
provide as much detail and context as possible.


## Pull requests

Good pull requests—patches, improvements, new features—are a fantastic
help. They should remain focused in scope and avoid containing unrelated
commits.

**Please ask first** before embarking on any significant pull request (e.g.
implementing features, refactoring code),
otherwise you risk spending a lot of time working on something that the
project's developers might not want to merge into the project.

Adhering to the following process is the best way to get your work included in the project:

* [Fork](http://help.github.com/fork-a-repo/) the project and clone your fork.
* Create a topic branch from where you want to base your work.
  * This is usually the master branch.
  * Only target other branches if you are certain your fix must be on that
    branch.
  * To quickly create a topic branch based on master; `git checkout -b
    fix/master/my_contribution master`. Please avoid working directly on the
    `master` branch.
* Make commits of logical units.
* Check for unnecessary whitespace with `git diff --check` before committing.
* If possible, add the necessary tests for your changes.
* Run _all_ the tests to assure nothing else was accidentally broken.
* Push your topic branch up to your fork
* [Open a Pull Request](https://help.github.com/articles/using-pull-requests/) with a clear title and description against the `master` branch.