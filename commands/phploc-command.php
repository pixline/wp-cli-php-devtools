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
		 * wp phploc run <slug>
		 *
		 * @synopsis <slug> [--flags]
		 *
		 * @since 0.2.1
		 */
		public function run( $args = null, $assoc_args = null ){
			if ( isset( $assoc_args['flags'] ) ):
				$default_flags = $assoc_args['flags'] . ' ';
			else :
				$default_flags = '--names="*.php" --count-tests --progress ';
			endif;
			if ( null !== $args[0] ):
				self::_run_phploc( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
			endif;
		}
		
		
		private function _run_phploc( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::launch( 'phploc '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phploc '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
		}
	}

	WP_CLI::add_command( 'phploc', 'WP_CLI_Phploc_Command' );
}
