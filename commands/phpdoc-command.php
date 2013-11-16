<?php
/**
 * wp-cli phpdoc command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * phpDocumentor: generate project documentation.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpdoc_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Documentor
		 *
		 * ## OPTIONS
		 *
		 * <folder>
		 * : Folder to generate
		 *
		 * ## EXAMPLES
		 *
		 * wp phpdoc run folder/
		 *
		 * @synopsis <folder>
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			#print_r($assoc_args);
			if ( null === $args[0] ):
				WP_CLI::error( 'Usage: wp phpdoc run <folder>' );
			else :
				$cmd = 'phpdoc.php list';
				WP_CLI::launch( $cmd );
			endif;
		}
	}

	WP_CLI::add_command( 'phpdoc', 'WP_CLI_Phpdoc_Command' );
}
