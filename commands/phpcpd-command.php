<?php
/**
 * wp-cli phpcpd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Copy/Paste Detector: find duplicate PHP code.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcpd_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Copy/Paste Detector
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * [--flags=<flags>]
		 * : phpcpd command line options. Default: '--progress'
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcpd uploadplus
		 * wp phpcpd twentythirteen --flags='--min-lines=2 --min-tokens=30'
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
				$default_flags = '--progress ';
			endif;
			if ( null !== $args[0] ):
				self::_run_phpcpd( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
			endif;
		}
		
		private function _run_phpcpd( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::line( 'phpcpd '.$flags . $theme_path );
				WP_CLI::launch( 'phpcpd '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::line( 'phpcpd '.$flags . $plugin_path );
				WP_CLI::launch( 'phpcpd '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
		}
		
	}

	WP_CLI::add_command( 'phpcpd', 'WP_CLI_Phpcpd_Command' );
}
