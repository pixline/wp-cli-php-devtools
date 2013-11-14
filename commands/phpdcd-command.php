<?php
/**
 * wp-cli phpdcd command
 *
 * @author Paolo Tresso <plugins@swergroup.com>
 * @version 0.1.0
 */

if ( true === class_exists( 'WP_CLI_Command' ) ){
	/**
	 * PHP Dead Code Detector: find dead/unused PHP code.
	 *
	 * @since 0.1.0
	 */
	class WP_CLI_Phpdcd_Command extends WP_CLI_Command{
		
		/**
		 * Run PHP Dead Code Detector
		 *
		 * ## OPTIONS
		 *
		 * <folder>
		 * : Folder to check
		 *
		 * --recursive
		 * : Report code as dead if it is only called by dead code.
		 *
		 * --exclude=<dir>
		 * : Exclude <dir> from code analysis
		 *
		 * --suffixes=<suffixes>
		 * : A comma-separated list of file suffixes to check.
		 *
		 * --verbose
		 * : Print progress bar.
		 *
		 * ## EXAMPLES
		 *
		 * wp phpdcd run path/to/plugin
		 * wp phpdcd run --recursive path/to/plugin
		 * wp phpdcd run --recursive --exclude=tests --exclude=vendor path/to/plugin
		 *
		 * @synopsis [--recursive] [--exclude=<exclude>] [--suffixes=<suffixes>] [--verbose] <folder>
		 *
		 * @since 0.1.0
		 */
		public function run( $args = null, $assoc_args = null ){
			#print_r($assoc_args);
			
			$switches = '';
			if ( isset( $assoc_args['exclude'] ) ){
				$excludes = explode( ',', $assoc_args['exclude'] );
				foreach ( $excludes as $avoid ):
					$switches .= '--exclude ' . $avoid . ' ';
				endforeach;
			}
			$switches .= '--verbose ';
			
			if ( null === $args[0] ):
				WP_CLI::error( 'Usage: wp phpdcd run [switches] <folder>' );
			else:
				# WP_CLI::launch( 'phpcs -i' );
				$cmd = 'phpdcd ' . $switches . $args[0];
				WP_CLI::launch( $cmd );
			endif;
		}
	}

	WP_CLI::add_command( 'phpdcd', 'WP_CLI_Phpdcd_Command' );
}
