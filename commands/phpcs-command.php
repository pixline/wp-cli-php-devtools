<?php
/**
 * wp-cli phpcs command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.2.1
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP CodeSniffer: detects violations of a defined set of coding standards.
	 *
	 * This wp-cli command is a WP-focused wrapper around PHP CodeSniffer.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpcs_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Code Sniffer on theme or plugin folder
		 *
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * --flags=[flags]
		 * : phpcs command line options. Default: '-p'.
		 * '--standard=WordPress' is declared by default.
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcs run uploadplus
		 * wp phpcs run twentythirteen --flags='-n -p -s -v'
		 *
		 * @synopsis <slug> [--flags]
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			if ( isset( $assoc_args['flags'] ) ):
				$default_flags = $assoc_args['flags'] . ' --standard=WordPress ';
			else :
				$default_flags = '-p --standard=WordPress ';
			endif;
				
			if ( null !== $args[0] ):
				self::_run_phpcs( $args[0], $default_flags );
			else :
				WP_CLI::error( 'Missing plugin/theme slug.' );
				/*
			elseif ( null != $assoc_args['files'] ):
				$checklist = explode( ',', $assoc_args['files'] );
				foreach ( $checklist as $check ):
					WP_CLI::launch( 'phpcs -s -p -v --standard=WordPress ' . $check );
				endforeach;
				*/
			endif;
		}
		
		/**
		 * Verify plugin or theme path, run phpcs when found
		 *
		 * @since 0.2.1
		 */
		private function _run_phpcs( $slug, $flags ){
			$plugin_path = WP_PLUGIN_DIR . '/' . $slug;
			$theme_path = WP_CONTENT_DIR . '/themes/' . $slug;
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				WP_CLI::launch( 'phpcs '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phpcs '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'Neither theme nor plugin slug provided.' );
			endif;
		}
		
	}

	WP_CLI::add_command( 'phpcs', 'WP_CLI_Phpcs_Command' );
}
