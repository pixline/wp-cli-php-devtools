<?php
/**
 * wp-cli phpcs command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Code Sniffer: detects violations of a defined set of coding standards.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcs_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phpcs', 'WP_CLI_Phpcs_Command' );
}
