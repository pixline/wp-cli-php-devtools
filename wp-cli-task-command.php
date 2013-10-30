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

			# check PHP version
			if (version_compare(phpversion(), '5.4.0', '<')) {
				WP_CLI::error( 'wp task requires PHP >= 5.4.0 ' );
			}
			# check PEAR
			require_once 'System.php';
			if ( true === class_exists( 'System' ) ) {
			   WP_CLI::launch( 'pear version' );
			} else {
			   WP_CLI::warning( 'Could not find PEAR. Please install it and retry:' );
			   WP_CLI::warning( 'http://pear.php.net/manual/en/installation.php' );
			}

			$checklist = array(
				'phpunit' => array(
					'check' => 'phpunit --version',
					'url' => 'http://phpunit.de/manual/3.7/en/installation.html'
				),
				'scrutinizer' => array(
					'check' => 'scrutinizer --version',
					'url' => 'https://github.com/scrutinizer-ci/scrutinizer/'
				),
				'phpcs' => array(
					'check' => 'phpcs --version',
					'url' => 'https://github.com/squizlabs/PHP_CodeSniffer',
				),
				'phploc' => array(
					'check' => 'phploc --version',
					'url' => 'https://github.com/sebastianbergmann/phploc',
				),
				'phpcpd' => array(
					'check' => 'phpcpd --version',
					'url' => 'https://github.com/sebastianbergmann/phpcpd',
				),
				'phpcov' => array(
					'check' => 'phpcov --version',
					'url' => 'https://github.com/sebastianbergmann/phpcov',
				),
				'phpdcd' => array(
					'check' => 'phpdcd --version',
					'url' => 'https://github.com/sebastianbergmann/dcd',
				),
				'phpdoc' => array(
					'check' => 'phpdoc --version',
					'url' => 'http://www.phpdoc.org/docs/latest/for-users/installation.html'
				),
				'phpmd' => array(
					'check' => 'phpmd --version',
					'url' => 'http://phpmd.org/download/index.html'
				)
			);

			foreach ( $checklist as $key => $info ):
				$test = exec( 'which ' . $key );
				if ( NULL !== $test ) {
				   WP_CLI::launch( $info['check'] );
				} else {
				   WP_CLI::warning( 'Could not find '.$key.', please install it and retry:' );
					 WP_CLI::warning( $info['url'] );
				}
			endforeach;

			# PHP CodeSniffer WP Coding Standard
			$pear_config_dir = exec( 'pear config-get php_dir' );
			$wp_phpcs_path = $pear_config_dir . '/PHP/CodeSniffer/Standards/WordPress';
			if ( false === is_dir( $wp_phpcs_path ) ):
				exec( 'git clone git://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards.git $(pear config-get php_dir)/PHP/CodeSniffer/Standards/WordPress' );
			endif;

			require_once 'PHP/CodeCoverage/Autoload.php';
			if ( true === class_exists( 'PHP_CodeCoverage' ) ) {
			   WP_CLI::launch( 'pear version' );
			} else {
			   WP_CLI::warning( 'Could not find PHP_CodeCoverage. Please install it and retry:' );
			   WP_CLI::warning( 'https://github.com/sebastianbergmann/php-code-coverage' );
			}


		}

		/**
		 * Setup task environment
		 *
		 * ## EXAMPLES
		 *
		 * wp task doctor
		 *
		 * @since 0.1.0
		 */
		public function doctor(){
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
