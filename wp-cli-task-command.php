<?php
/**
 * Grunt.js partial replacement command(s)
 *
 * @author pixline <pixline@gmail.com>
 * @version 0.1.0
 * @when before_wp_load
 * @synopsis <action>
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	class Pixline_Task_Cmd extends WP_CLI_Command{

		private function _check_env(){
			WP_CLI::log( 'Checking environment..' );
			# check PEAR
			require_once 'System.php';
			if ( true === class_exists( 'System' ) ) {
			   WP_CLI::launch( 'pear version' );
			} else {
			   WP_CLI::error( 'Could not find PEAR. Please install/check PEAR and restart setup.' );
			}
			WP_CLI::launch('$(pwd)/vendor/bin/scrutinizer --version');
			WP_CLI::launch('$(pwd)/vendor/bin/phpunit --version');
		}


		/**
		 * Setup task environment
		 *
		 * ## EXAMPLES
		 *
		 * wp task setup
		 *
		 * @since 0.1.0
		 */
		public function setup(){
			$this->_check_env();
		}
	
		public function asciify(){}
		public function compress(){}
		public function csslint(){}
		public function cssmin(){}
		public function jslint(){}
		public function phpcs(){}
		public function phpdoc(){}
		public function phplint(){}		
		public function scrutinizer(){}
		public function shell(){}
		public function uglify(){}
	}

	WP_CLI::add_command( 'task', 'Pixline_Task_Cmd' );
}
