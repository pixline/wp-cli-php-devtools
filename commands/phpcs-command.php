<?php
/**
 * wp-cli phpcs command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP CodeSniffer: detects violations of a defined set of coding standards.
	 *
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcs_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Code Sniffer over a theme or plugin folder.
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * --flags=[flags]
		 * : phpcs command line options. Default: '-p'
		 *
		 * ## USAGE
		 *
		 * Command looks for a plugin or theme folder and run phpcs on that:
		 *
		 *		phpcs -p --standard=WordPress --extensions=php path/to/folder
		 *
		 * Optional --flags will overwrite the variable section of the commandline above
		 * ('-p') , while --standard and --extensions are by default. Setting flags like
		 * --flags='-s -v' equals this command:
		 * 
		 *	phpcs -s -v --standard=WordPress --extensions=php
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcs uploadplus
		 * wp phpcs twentythirteen --flags='-n -p -s -v'
		 *
		 * @synopsis <slug> [--flags]
		 *
		 * @since 0.1.0
		 */
		public function __invoke( $args = null, $assoc_args = null ){
			if ( isset( $assoc_args['flags'] ) ):
				$default_flags = $assoc_args['flags'] . ' --standard=WordPress --extensions=php ';
			else :
				$default_flags = '-p --standard=WordPress --extensions=php ';
			endif;
				
			if ( null !== $args[0] ):
				self::_run_phpcs( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
			endif;
		}
		
		/**
		 * Verify plugin or theme path, run phpcs when found
		 *
		 * @since 0.2.1
		 */
		private function _run_phpcs( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::launch( 'phpcs '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phpcs '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'No theme or plugin with that slug.' );
			endif;
		}
		
	}

	WP_CLI::add_command( 'phpcs', 'WP_CLI_Phpcs_Command' );
}
