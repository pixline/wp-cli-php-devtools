<?php
/**
 * wp-cli minify command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Combines and minifies JavaScript and CSS files.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Minify_Command extends WP_CLI_Command{
		
		public function run( $args = null, $assoc_args = null ){
		}
	}

	WP_CLI::add_command( 'minify', 'WP_CLI_Minify_Command' );
}
