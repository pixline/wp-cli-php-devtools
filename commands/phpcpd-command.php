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
		 * <folder>
		 * : Folder to check
		 *
		 * --exclude=<dir>
		 * : Exclude <dir> from code analysis
		 *
		 * ## EXAMPLES
		 *
		 * wp phpcpd run path/to/plugin
		 *
		 * @synopsis [--exclude=<exclude>] <folder>
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
			$switches .= '--progress ';
			
			if ( null === $args[0] ):
				WP_CLI::error( 'Usage: wp phpdcd run [switches] <folder>' );
			else:
				# WP_CLI::launch( 'phpcs -i' );
				$cmd = 'phpcpd ' . $switches . $args[0];
				WP_CLI::launch( $cmd );
			endif;
		}
	}

	WP_CLI::add_command( 'phpcpd', 'WP_CLI_Phpcpd_Command' );
}
