# wp-cli devtools

[![Build Status](https://travis-ci.org/pixline/wp-cli-devtools.png?branch=master)](https://travis-ci.org/pixline/wp-cli-devtools)

Useful wrapper around common cli utilities:

* `phpcs` -- Detects violations of a defined set of coding standards via [PHP Code Sniffer](https://github.com/squizlabs/php_codesniffer).
* `phpmd` -- Analyze source code for several potential problems via [PHP Mess Detector](https://github.com/phpmd/phpmd)
* `phpunit` -- Run [PHPunit](https://github.com/sebastianbergmann/phpunit) unit tests.
* `phpcpd` -- Find duplicate PHP code via [PHP Copy/Paste Detector](https://github.com/sebastianbergmann/phpcpd)
* `phpdcd` -- Find dead/unused PHP code via [PHP Dead Code Detector](https://github.com/sebastianbergmann/phpdcd)
* `phploc` -- Measure the size of a PHP project via [PHP Lines of Code](https://github.com/sebastianbergmann/phploc)

Work in progress:

* `minify` -- Combines and minifies JavaScript and CSS files via YUI Compressor.
* `phpdoc` -- Generate project documentation via phpDocumentor.
* `phpcov` -- Measure and report code testing coverage via PHP_CodeCoverage.

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
