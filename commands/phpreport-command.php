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
		
		
		/**
		 * Run every PHP dev tool at once.
		 *
		 * ## OPTIONS
		 *
		 * <slug>
		 * : Plugin or theme slug to check.
		 *
		 * ## USAGE
		 *
		 * Command will run with their default settings in this order:
		 *   - phpcpd
		 *   - phpcs
		 *   - phpdcd
		 *   - phploc
		 *   - phpmd
		 *   - phpunit
		 *
		 * To configure each command you can use your wp-cli.yml configuration file,
		 * run `wp phpreport config` to show a sample file.
		 *
		 * ## EXAMPLES
		 *
		 * wp phpreport run uploadplus
		 * wp phpreport config
		 *
		 * @synopsis <slug>
		 *
		 * @since 0.2.2
		 */
		public function run( $args = null, $assoc_args = null ){
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

		/**
		 * Show phpreport sample wp-cli.yml file.
		 */
		public function config(){
			$config = <<<CONFIG

Sample wp-cli.yml configuration
-------------------------------

phpcpd:
  plugin-or-theme-slug:
    flags: --min-lines=2 --min-tokens=30
phpcs:
  plugin-or-theme-slug:
    flags: -p --ignore=lib,tests
phpdcd:
  plugin-or-theme-slug:
    flags: --recursive --suffixes php --exclude vendor
phploc:
  plugin-or-theme-slug:
    flags: --names="*.php" --log-xml
phpmd:
  plugin-or-theme-slug:
    flags: json codesize,naming,unusedcode --suffixes=php
phpunit:
  run:
    plugin: plugin-slug
    unit-tests: /home/user/src/wp-unit-tests/

CONFIG;
			WP_CLI::line( $config );
		}

		private function _do_commands( $slug, $path ){
			
			$routine = array(
				'phpcpd' => array(
					'launch' => 'wp phpcpd ' . $slug,
					'success' => 'PHP Copy/Paste Detector',
				),
				'phpcs' => array(
					'launch' => 'wp phpcs ' . $slug,
					'success' => 'PHP CodeSniffer',
				),
				'phpdcd' => array(
					'launch' => 'wp phpdcd ' . $slug,
					'success' => 'PHP Dead Code Detector',
				),
				'phploc' => array(
					'launch' => 'wp phploc ' . $slug,
					'success' => 'PHP Lines of Code ',
				),
				'phpmd' => array(
					'launch' => 'wp phpmd ' . $slug,
					'success' => 'PHP Mess Detector',
				),
				'phpunit' => array(
					'launch' => 'wp phpunit --plugin=' . $slug,
					'success' => 'PHPunit',
				),
			);
			
			foreach ( $routine as $label => $commands ):
				self::_run_cmd( $label, $commands );
			endforeach;
		}

		private function _run_cmd( $label, $commands ){
			WP_CLI::launch( $commands['launch'] );
			WP_CLI::success( $commands['success'] );
			WP_CLI::line( '' );
		}

		

	}

	WP_CLI::add_command( 'phpreport', 'WP_CLI_Phpreport_Command' );
}
