<?php
/**
 * wp-cli phploc command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Wrapper around phploc.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phploc_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phploc', 'WP_CLI_Phploc_Command' );
}
