# wp-cli DevTools

Wrapper commands around common utilities:

* phpcs -- PHP Code Sniffer: detects violations of a defined set of coding standards.
* phpmd -- PHP Mess Detector: analyze source code for several potential problems.
* phpunit -- Run PHPunit unit tests.

Upcoming commands:

* minify -- Combines and minifies JavaScript and CSS files.
* phpcov --  PHP_CodeCoverage: measure and report testing coverage.
* phpcpd -- PHP Copy/Paste Detector: find duplicate PHP code.
* phpdcd -- PHP Dead Code Detector: find dead/unused PHP code.
* phpdoc -- phpDocumentor: generate project documentation.
* phploc -- PHP Lines of Code: measure the size of a PHP project.

## System Requirements

* PHP >=5.4
* Composer
* wp-cli

## Setup

* Install wp-cli:

* Install wp-cli-devtools

```
cd /path/to/wp-cli/
composer require pixline/wp-cli-devtools=dev-master
```

* Add wp-cli bin/ folder to $PATH:

```
echo 'PATH="/path/to/wp-cli/bin/:$PATH" >> .profile
```
