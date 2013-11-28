<?php
/**
 * wp-cli phpcpd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
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
		 *
		 * --flags=<flags>
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcpd run uploadplus
		 *
		 * @synopsis <slug> [--flags]
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			if ( isset( $assoc_args['flags'] ) ):
				$default_flags = $assoc_args['flags'] . ' ';
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
				WP_CLI::launch( 'phpcpd '.$flags . $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				WP_CLI::launch( 'phpcpd '.$flags . $plugin_path );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
			/*
			$switches = '';
			if ( isset( $assoc_args['exclude'] ) ){
				$excludes = explode( ',', $assoc_args['exclude'] );
				foreach ( $excludes as $avoid ):
					$switches .= '--exclude ' . $avoid . ' ';
				endforeach;
			}
			$switches .= '--progress ';
			
			if ( null === $args[0] ):
				WP_CLI::error( 'Usage: wp phpdcd run [switches] <folder>' );
			else :
				$cmd = 'phpcpd ' . $switches . $args[0];
				WP_CLI::launch( $cmd );
			endif;
			*/
			
		}
		
	}

	WP_CLI::add_command( 'phpcpd', 'WP_CLI_Phpcpd_Command' );
}
