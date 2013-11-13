<?php
/**
 * wp-cli phpcpd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Copy/Paste Detector: find duplicate PHP code.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcpd_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phpcpd', 'WP_CLI_Phpcpd_Command' );
}
