<?php
/**
 * wp-cli phpcov command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP_CodeCoverage: measure and report testing coverage.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcov_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phpcov', 'WP_CLI_Phpcov_Command' );
}
