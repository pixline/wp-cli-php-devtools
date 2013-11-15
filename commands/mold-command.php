<?php
/**
 * wp-cli mold command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP_CodeCoverage: measure and report testing coverage.
	 *
	 * @since 0.1.0
	 * @when before_wp_load
	 */
	class WP_CLI_Mold_Command extends WP_CLI_Command{
		
		/**
		 * Creates a mold plugin project
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 *
		 * [--activate]
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function theme( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}

		/**
		 * Creates a mold theme project
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 *
		 * [--activate]
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function theme( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}

		/**
		 * Build your theme into specified directory
		 *
		 * ## OPTIONS
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function build( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}


		/**
		 * This command will symlink the compiled version of the theme to the specified path
		 *
		 * ## OPTIONS
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function ( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}
		
		/**
		 * Compile and zip your project to FILENAME.zip
		 *
		 * ## OPTIONS
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function package( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}

		/**
		 * Watches the source directory in your project for changes, and reflects those changes in a compile folder
		 *
		 * ## OPTIONS
		 *
		 * ## EXAMPLES
		 *
		 *
		 *
		 * @when before_wp_load
		 */
		public function watch( $args = null, $assoc_args = null ){
			WP_CLI::error( 'Sorry, command not implemented (yet).' );
		}
		
	}

	WP_CLI::add_command( 'mold', 'WP_CLI_Mold_Command' );
}
