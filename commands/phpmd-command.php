<?php
/**
 * wp-cli phpmd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
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
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * --flags=[flags]
		 * : phpmd command line options. Defaults: 
		 * 'text codesize,controversial,design,naming,unusedcode --suffixes=php'
		 *
		 * ## EXAMPLES
		 *
		 * wp phpmd uploadplus
		 * wp phpmd twentythirteen --flags='json codesize,naming,unusedcode --suffixes=php'
		 *
		 * @synopsis <slug> [--flags]
		 *
		 * @since 0.1.0
		 */
		public function __invoke( $args = null, $assoc_args = null ){
			if ( isset( $assoc_args['flags'] ) ):
				$default_flags = $assoc_args['flags'] . ' ';
			else :
				$default_flags = ' text codesize,controversial,design,naming,unusedcode --suffixes=php ';
			endif;
			if ( null !== $args[0] ):
				self::_run_phpmd( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
			endif;
		}
		
		
		private function _run_phpmd( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::launch( 'phpmd '. $theme_path . $flags );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phpmd '. $plugin_path . $flags );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
		}

	}

	WP_CLI::add_command( 'phpmd', 'WP_CLI_Phpmd_Command' );
}
