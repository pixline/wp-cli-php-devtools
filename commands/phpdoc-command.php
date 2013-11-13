<?php
/**
 * wp-cli phpdoc command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Wrapper around phpdocumentor to ease documentation production.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpdoc_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phpdoc', 'WP_CLI_Phpdoc_Command' );
}
