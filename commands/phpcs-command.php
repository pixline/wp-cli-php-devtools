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
		
		/**
		 * Run PHP Code Sniffer
		 *
		 * ## OPTIONS
		 *
		 * --files=<files>
		 * : Comma-separated files or paths to check
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcs run path/to/plugin/
		 *
		 * @synopsis --files=<files>
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			#print_r($assoc_args);
			if ( null === $assoc_args['files'] ):
				WP_CLI::error( 'Usage: wp phpcs <path>' );
			else:
				# WP_CLI::launch( 'phpcs -i' );
				$checklist = explode( ',', $assoc_args['files'] );
				foreach( $checklist as $check ):
					WP_CLI::launch( 'phpcs -s -p -v --standard=WordPress ' . $check );
				endforeach;
			endif;
		}
	}

	WP_CLI::add_command( 'phpcs', 'WP_CLI_Phpcs_Command' );
}
