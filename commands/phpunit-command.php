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
		
		
		private function _do_core( $unit_tests_dir ){
			WP_CLI::line( 'Doing Core' );
			if ( is_dir( $unit_tests_dir ) ):
				WP_CLI::launch( 'cd ' . $unit_tests_dir . ' && phpunit' );
			else :
				WP_CLI::error( 'Please run `wp core install-tests` first!' );
			endif;
		}
		
		private function _do_plugin( $slug, $tests ){
			WP_CLI::line( 'Doing Plugin ' . $slug );
			$plugin_dir = WP_PLUGIN_DIR . '/' . $slug;
			if ( is_dir( $plugin_dir ) ):
				WP_CLI::launch( 'export WP_TESTS_DIR='.$tests.'; cd ' . $plugin_dir . '; phpunit -c phpunit.xml ' );
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
		 * --tests-folder=<tests>
		 * : Optional WordPress unit tests folder
		 *
		 * ## EXAMPLES
		 *
		 * wp phpunit run --core
		 * wp phpunit run --plugin=plugin-slug
		 * wp phpunit run --core --unit_tests=/home/user/src/wp-unit-tests/
		 *
		 * @synopsis [--core] [--plugin=<plugin>] [--tests-folder=<tests>]
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			$unit_tests_dir = ( false === isset( $assoc_args['unit_test'] ) ) ? ABSPATH . '/unit-tests' : $assoc_args['unit_test'];
			
			if ( isset( $assoc_args['core'] ) ):
				self::_do_core( $unit_tests_dir );

			elseif ( isset( $assoc_args['plugin'] ) && null !== $assoc_args['plugin'] ):
				self::_do_plugin( $assoc_args['plugin'], $unit_tests_dir );

			else :
				WP_CLI::line( 'Usage: wp phpunit [--core] [--plugin=<plugin>]' );

			endif;
		}
	}

	WP_CLI::add_command( 'phpunit', 'WP_CLI_Phpunit_Command' );
}
