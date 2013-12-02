<?php
/**
 * wp-cli phpdcd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Dead Code Detector: find dead/unused PHP code.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpdcd_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Dead Code Detector
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * [--flags=<flags>]
		 * : phpdcd command line options. Default: '--suffixes php'
		 *
		 * ## EXAMPLES
		 *
		 *	wp phpdcd uploadplus
		 *	wp phpdcd twentythirteen --flags="--recursive --suffixes php --exclude vendor"
		 *
		 * @synopsis <slug> [--flags=<flags>]
		 *
		 * @since 0.1.0
		 */
		public function __invoke( $args = null, $assoc_args = null ){
			if (
				isset( $assoc_args['flags'] ) ||
				isset( $assoc_args[$args[0]]['flags'] )
				):
				$custom = isset( $assoc_args[$args[0]]['flags'] ) ? $assoc_args[$args[0]]['flags'] : $assoc_args['flags'];				
				$default_flags = $custom . ' ';
			else :
				$default_flags = '--suffixes php ';
			endif;
			if ( null !== $args[0] ):
				self::_run_phpdcd( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
			endif;
		}

		private function _run_phpdcd( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::launch( 'phpdcd '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phpdcd '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
		}
		
	}

	WP_CLI::add_command( 'phpdcd', 'WP_CLI_Phpdcd_Command' );
}
