<?php
/**
 * wp-cli phploc command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
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
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * [--flags=<flags>]
		 * : phploc command line options. Defaults : 
		 * '--names="*.php" --count-tests --progress'
		 *
		 * ## EXAMPLES
		 *
		 * wp phploc uploadplus
		 * wp phploc twentythirteen --flags='--names="*.php" --log-xml'
		 *
		 * @synopsis <slug> [--flags=<flags>]
		 *
		 * @since 0.2.1
		 */
		public function __invoke( $args = null, $assoc_args = null ){
			if (
				isset( $assoc_args['flags'] ) ||
				isset( $assoc_args[$args[0]]['flags'] )
				):
				$custom = isset( $assoc_args[$args[0]]['flags'] ) ? $assoc_args[$args[0]]['flags'] : $assoc_args['flags'];				
				$default_flags = $custom . ' ';
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
