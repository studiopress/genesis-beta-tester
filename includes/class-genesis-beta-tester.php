<?php
/**
 * Genesis Beta Tester file.
 *
 * @package genesis-beta-tester
 */

/**
 * The main class.
 *
 * @package Genesis Beta Tester
 * @since 1.0
 */
class Genesis_Beta_Tester {

	/** Constructor */
	public function __construct() {

		add_filter( 'http_request_args', array( $this, 'update_remote_post_options_filter' ), 10, 2 );

		load_plugin_textdomain( 'genesis-beta-tester', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

	}

	/**
	 * Filter to flag for beta testing
	 *
	 * @param array $options Options.
	 * @param array $url URL.
	 */
	public function update_remote_post_options_filter( $options, $url ) {

		if ( 'https://api.genesistheme.com/update-themes/' === $url ) {
			$options['body']['beta_tester'] = 1;
		}

		return $options;

	}

}
