<?php
/*
	Plugin Name: Genesis Beta Tester
	Plugin URI: http://www.studiopress.com/plugins/genesis-beta-tester
	Description: Genesis Beta Tester lets you one-click update to the latest version of Genesis, even if it is still in beta.
	Author: Nathan Rice
	Author URI: http://www.nathanrice.net/

	Version: 0.9.1

	License: GNU General Public License v2.0 (or later)
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/

register_activation_hook( __FILE__, 'genesis_beta_tester_activation_hook' );
/**
 * Activation Hook
 */
function genesis_beta_tester_activation_hook() {
	
	$latest = '1.9.2';

	$theme_info = get_theme_data( TEMPLATEPATH . '/style.css' );

	if ( 'genesis' != basename( TEMPLATEPATH ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
		wp_die( sprintf( __( 'Sorry, you can\'t activate unless you have installed <a href="%s">Genesis</a>', 'genesis-beta-tester' ), 'http://www.studiopress.com/themes/genesis' ) );
	}

	if ( version_compare( $theme_info['Version'], $latest, '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) ); /** Deactivate ourself */
		wp_die( sprintf( __( 'Sorry, you cannot activate without Genesis %s or greater', 'genesis-beta-tester' ), $latest ) );
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
	function __construct() {
		
		add_filter( 'genesis_update_remote_post_options', array( $this, 'update_remote_post_options_filter' ) );
	
	}
	
	/** Filter to flag for beta testing */
	function update_remote_post_options_filter( $options ) {
		
		$options['body']['beta_tester'] = 1;
		
		return $options;
		
	}

}

add_action( 'plugins_loaded', 'genesis_beta_tester_init' );
/**
 * Instantiate the main class.
 *
 */
function genesis_beta_tester_init() {
	new Genesis_Beta_Tester;
}