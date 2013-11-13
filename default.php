<?php
/**
 * wp-cli devtools
 *
 * Wrappers around common PHP/JS/CSS cli utilities.
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

// php-min
include( 'commands/minify-command.php' );

// PHP Coverage
include( 'commands/phpcov-command.php' );

// PHP Copy/Paste Detection
include( 'commands/phpcpd-command.php' );

// PHP Dead Code Detection
include( 'commands/phpdcd-command.php' );

// PHP Documentor
include( 'commands/phpdoc-command.php' );

// PHP Line of Code
include( 'commands/phploc-command.php' );

// PHP Mess Detection
include( 'commands/phpmd-command.php' );

// PHPunit
include( 'commands/phpunit-command.php' );

?>