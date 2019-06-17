<?php
/**
 * Plugin Name: Genesis Beta Tester
 * Plugin URI: http://www.studiopress.com/plugins/genesis-beta-tester
 * Description: Genesis Beta Tester lets you one-click update to the latest version of Genesis, even if it is still in beta.
 * Author: Nathan Rice
 * Author URI: http://www.nathanrice.net/

 * Version: 0.9.5

 * Text Domain: genesis-beta-tester
 * Domain Path: /languages/

 * License: GNU General Public License v2.0 (or later)
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 *
 * @package genesis-beta-tester
 */

register_activation_hook( __FILE__, 'genesis_beta_tester_activation_hook' );
/**
 * Activation Hook
 */
function genesis_beta_tester_activation_hook() {

	$latest = '1.9.2';

	if ( 'genesis' !== basename( get_template_directory() ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
		/* Translators: The string is a url to the genesis framework. */
		wp_die( sprintf( esc_html( __( 'Sorry, you can\'t activate unless you have installed <a href="%s">Genesis</a>', 'genesis-beta-tester' ), 'http://www.studiopress.com/themes/genesis' ) ) );
	}

	if ( version_compare( wp_get_theme()->parent()->get( 'Version' ), $latest, '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
		/* Translators: The string is the lowest version of Genesis needed to activate. */
		wp_die( sprintf( esc_html( __( 'Sorry, you cannot activate without Genesis %s or greater', 'genesis-beta-tester' ) ), esc_attr( $latest ) ) );
	}

	/** Delete the Genesis update transient to force an update check */
	delete_transient( 'genesis-update' );

}

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

add_action( 'plugins_loaded', 'genesis_beta_tester_init' );
/**
 * Instantiate the main class.
 */
function genesis_beta_tester_init() {
	new Genesis_Beta_Tester();
}
