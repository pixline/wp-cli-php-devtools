<?php
/**
 * Grunt.js partial replacement command(s)
 *
 * @author pixline <pixline@gmail.com>
 * @version 0.1.0
 * @when before_wp_load
 * @synopsis <action>
 */

class Pixline_Task_Cmd extends WP_CLI_Command{

	private function _check_env(){

		# check PEAR
		require_once 'System.php';
		if ( true === class_exists( 'System' ) ) {
		   WP_CLI::success( 'PEAR is installed. Skip installation.' );
		} else {
		   WP_CLI::error( 'PEAR is not installed. Please install PEAR and run setup again.' );
		}

		

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