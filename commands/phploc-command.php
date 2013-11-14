<?php
/**
 * wp-cli phploc command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Lines of Code: measure the size of a PHP project.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phploc_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Lines of Code
		 *
		 * ## OPTIONS
		 *
		 * <folder>
		 * : Folder to check
		 *
		 * ## EXAMPLES
		 *
		 * wp phpmd run folder/
		 *
		 * @synopsis <folder>
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			#print_r($assoc_args);
			if ( null === $args[0] ):
				WP_CLI::error( 'Usage: wp phloc run <folder>' );
			else:
				# WP_CLI::launch( 'phpcs -i' );
				$cmd = 'phploc --progress ' . $args[0] . '';
				WP_CLI::launch( $cmd );
			endif;
		}
	}

	WP_CLI::add_command( 'phploc', 'WP_CLI_Phploc_Command' );
}
