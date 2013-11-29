<?php
/**
 * wp-cli phpreport command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Run several commands at once over a plugin/theme
	 *
	 * @since 0.2.2
	 */
	class WP_CLI_Phpreport_Command extends WP_CLI_Command{
		
		public function __invoke( $args = null, $assoc_args = null ){
			WP_CLI::line( 'Doing '. $args[0] );
			$plugin_path = WP_PLUGIN_DIR . '/' . $args[0];
			$theme_path  = WP_CONTENT_DIR . '/themes/' . $args[0];
			
			if ( is_dir( $theme_path ) && false === is_dir( $plugin_path )  ):
				self::_do_commands( $args[0], $theme_path );
			elseif ( is_dir( $plugin_path ) && false === is_dir( $theme_path ) ) :
				self::_do_commands( $args[0], $plugin_path );
			else :
				WP_CLI::error( 'Plugin/theme not found' );
			endif;
		}

		private function _do_commands( $slug, $path ){
			WP_CLI::success( 'PHP Copy/Paste Detector: '. $args[0] );
			WP_CLI::launch( 'wp phpcpd ' . $slug );

			WP_CLI::success( 'PHP CodeSniffer: '. $args[0] );
			WP_CLI::launch( 'wp phpcs ' . $slug );

			WP_CLI::success( 'PHP Dead Code Detector: '. $args[0] );
			WP_CLI::launch( 'wp phpdcd ' . $slug );

			WP_CLI::success( 'PHP Lines of Code: '. $args[0] );
			WP_CLI::launch( 'wp phploc ' . $slug );

			WP_CLI::success( 'PHP Mess Detector: '. $args[0] );
			WP_CLI::launch( 'wp phpmd ' . $slug );

			WP_CLI::success( 'PHPunit: '. $args[0] );
			WP_CLI::launch( 'wp phpunit --plugin=' . $slug );
		}


	}

	WP_CLI::add_command( 'phpreport', 'WP_CLI_Phpreport_Command' );
}
