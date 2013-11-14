<?php
/**
 * wp-cli phpmd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Mess Detector: analyze source code for several potential problems.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpmd_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Mess Detector
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
				WP_CLI::error( 'Usage: wp phpmd run <folder>' );
			else:
				# WP_CLI::launch( 'phpcs -i' );
				$cmd = 'phpmd ' . $args[0] . ' text codesize,controversial,design,naming,unusedcode --extensions=php';
				WP_CLI::launch( $cmd );
			endif;
		}
	}

	WP_CLI::add_command( 'phpmd', 'WP_CLI_Phpmd_Command' );
}
