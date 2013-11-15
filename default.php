<?php
/**
 * wp-cli devtools
 *
 * Wrappers around common PHP/JS/CSS cli utilities.
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.1
 */

// php-minify
#include( 'commands/minify-command.php' );

// PHP Coverage
#include( 'commands/phpcov-command.php' );

// PHP Copy/Paste Detector
include( 'commands/phpcpd-command.php' );

// PHP CodeSniffer
include( 'commands/phpcs-command.php' );

// PHP Dead Code Detector
include( 'commands/phpdcd-command.php' );

// PHP Documentor
#include( 'commands/phpdoc-command.php' );

// PHP Lines of Code
include( 'commands/phploc-command.php' );

// PHP Mess Detector
include( 'commands/phpmd-command.php' );

// PHPunit
include( 'commands/phpunit-command.php' );

?>