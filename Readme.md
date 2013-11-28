# wp-cli devtools

[![Build Status](https://travis-ci.org/pixline/wp-cli-devtools.png?branch=master)](https://travis-ci.org/pixline/wp-cli-devtools) [![Support](https://www.paypalobjects.com/it_IT/IT/i/btn/btn_donate_SM.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CX6VQ6FVJFN4L)


Useful commands/wrappers around common development and test utilities:

* `phpcpd` -- Find duplicate PHP code via [PHP Copy/Paste Detector](https://github.com/sebastianbergmann/phpcpd)
* `phpcs` -- Detects violations of a defined set of coding standards via [PHP Code Sniffer](https://github.com/squizlabs/php_codesniffer).
* `phpdcd` -- Find dead/unused PHP code via [PHP Dead Code Detector](https://github.com/sebastianbergmann/phpdcd)
* `phploc` -- Measure the size of a PHP project via [PHP Lines of Code](https://github.com/sebastianbergmann/phploc)
* `phpmd` -- Analyze source code for several potential problems via [PHP Mess Detector](https://github.com/phpmd/phpmd)
* `phpunit` -- Run [PHPunit](https://github.com/sebastianbergmann/phpunit) unit tests.

Also in the bundle a single command to run every command at once:

* `phpreport` -- Run phpcpd + phpcs + phpdcd + phploc + phpmd + phpunit over a single plugin/theme

Work in progress:

* `minify` -- Combines and minifies JavaScript and CSS files via YUI Compressor.
* `phpdoc` -- Generate project documentation via phpDocumentor.
* `phpcov` -- Measure and report code testing coverage via PHP_CodeCoverage.

## System Requirements

* PHP >=5.4
* Composer
* wp-cli

## Setup

* Install [wp-cli](https://wp-cli.org)
* Install wp-cli-devtools

```
cd /path/to/wp-cli/
composer require pixline/wp-cli-devtools=dev-master
```

* Add wp-cli bin/ folder to $PATH (!important):
```
echo 'PATH="/path/to/wp-cli/bin/:$PATH" >> .profile
```


## License

Copyright (c) 2013+ Paolo Tresso <plugins@swergroup.com>
Plugin released with the [MIT License](http://opensource.org/licenses/MIT)
