<?php
/**
 * wp-cli phpmd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Wrapper around phpmd.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpmd_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'phpmd', 'WP_CLI_Phpmd_Command' );
}
