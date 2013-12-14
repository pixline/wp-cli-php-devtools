<?php
/**
 * wp-cli phpunit command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * Run PHPunit unit tests
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpunit_Command extends WP_CLI_Command{
		
		
		private function _do_core( $unit_tests_dir, $default_flags ){
			WP_CLI::line( 'Doing Core' );
			if ( is_dir( $unit_tests_dir ) ):
				WP_CLI::line( 'cd ' . $unit_tests_dir . ' && phpunit ' . $default_flags );
				WP_CLI::launch( 'cd ' . $unit_tests_dir . ' && phpunit ' . $default_flags );
			else :
				WP_CLI::error( 'Please run `wp core install-tests` first!' );
			endif;
		}
		
		private function _do_plugin( $slug, $tests, $default_flags ){
			WP_CLI::line( 'Doing Plugin ' . $slug );
			$plugin_dir = WP_PLUGIN_DIR . '/' . $slug;
			if ( is_dir( $plugin_dir ) ):
				WP_CLI::line( 'export WP_TESTS_DIR='.$tests.'; cd ' . $plugin_dir . '; phpunit -c phpunit.xml ' . $default_flags );
				WP_CLI::launch( 'export WP_TESTS_DIR='.$tests.'; cd ' . $plugin_dir . '; phpunit -c phpunit.xml ' . $default_flags );
			else :
				WP_CLI::error( 'Can\'t find plugin folder: ' . $plugin_dir );
			endif;
		}
		
		/**
		 * Run unit tests
		 *
		 * ## OPTIONS
		 *
		 * --core
		 * : Run WordPress core unit tests
		 *
		 * --plugin=<plugin>
		 * : Run selected plugin unit tests
		 *
		 * --unit_tests=<unit_tests>
		 * : Optional WordPress unit tests folder
		 *
		 * [--flags=<flags>]
		 * : extra command line options
		 *
		 * ## EXAMPLES
		 *
		 * wp phpunit --core
		 * wp phpunit --plugin=plugin-slug
		 * wp phpunit --core --unit_tests=/home/user/src/wp-unit-tests/
		 *
		 * @synopsis [--core] [--plugin=<plugin>] [--unit_tests=<tests>] [--flags=<flags>]
		 *
		 * @since 0.1.0
		 */
		public function __invoke( $args = null, $assoc_args = null ){
			$unit_tests_dir = ( false === isset( $assoc_args['unit_tests'] ) ) ? ABSPATH . '/unit-tests' : $assoc_args['unit_tests'];
			
			if (
				isset( $assoc_args['flags'] ) ||
				isset( $assoc_args[$args[0]]['flags'] )
				):
				$custom = isset( $assoc_args[$args[0]]['flags'] ) ? $assoc_args[$args[0]]['flags'] : $assoc_args['flags'];
				$default_flags = $custom;
			else :
				$default_flags = '';
			endif;


			if ( isset( $assoc_args['core'] ) ):
				self::_do_core( $unit_tests_dir, $default_flags );

			elseif ( isset( $assoc_args['plugin'] ) && null !== $assoc_args['plugin'] ):
				self::_do_plugin( $assoc_args['plugin'], $unit_tests_dir, $default_flags );

			else :
				WP_CLI::line( 'Usage: wp phpunit [--core] [--plugin=<plugin>]' );

			endif;
		}
	}

	WP_CLI::add_command( 'phpunit', 'WP_CLI_Phpunit_Command' );
}
