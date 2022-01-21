<?php
/**
 * Fired during plugin activation.
 *
 * @package APcom-CPT
 * @link    https://github.com/ArmandPhilippot/apcom-cpt
 * @since   0.1.0
 */

namespace APcom_CPT;

/**
 * The responsible class of plugin internationalization.
 *
 * This class defines and load all the files needed for translation.
 *
 * @since 0.1.0
 */
class I18n {
	/**
	 * Load textdomain once plugin is loaded.
	 *
	 * @since 0.1.0
	 */
	public function init() {
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Load the plugin text domain.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'APComCPT', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}
}
