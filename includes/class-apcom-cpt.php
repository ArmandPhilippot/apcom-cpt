<?php
/**
 * Define the core plugin class.
 *
 * @package APcom-CPT
 * @link    https://github.com/ArmandPhilippot/apcom-cpt
 * @since   0.1.0
 */

namespace APcom_CPT;

/**
 * The core plugin class.
 *
 * This class defines defines internationalization, admin hooks, and public
 * hooks.
 */
class APcom_CPT {
	/**
	 * The plugin name.
	 *
	 * @since 0.1.0
	 * @var string $plugin_name The plugin name.
	 */
	protected $plugin_name;

	/**
	 * The description of this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @var    string The string used as description of this plugin.
	 */
	protected $plugin_description;

	/**
	 * The plugin version.
	 *
	 * @since 0.1.0
	 * @var string $plugin_version The current plugin version.
	 */
	protected $plugin_version;

	/**
	 * Define the plugin functionality.
	 *
	 * @since 0.1.0
	 * @since 1.1.0 Load admin hooks.
	 */
	public function __construct() {
		$this->plugin_version     = defined( APCOM_CPT_VERSION ) ? APCOM_CPT_VERSION : '1.0.0';
		$this->plugin_name        = 'APcom CPT';
		$this->plugin_description = __( 'Custom post types for my personal website.', 'APComCPT' );

		$this->load_dependencies();
		$this->set_locale();
	}

	/**
	 * Loads the required dependencies for this plugin.
	 *
	 * @since  0.1.0
	 *
	 * @access private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible of plugin internationalization.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * The class responsible of Custom Post Types registration.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cpt.php';
	}

	/**
	 * Define the locale used by the plugin.
	 *
	 * @since 0.1.0
	 */
	private function set_locale() {
		$translation = new I18n();
		$translation->init();
	}

	/**
	 * Execute the plugin.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		$this->set_locale();
	}

	/**
	 * Retrieve the plugin name.
	 *
	 * @since 0.1.0
	 *
	 * @return string The plugin name.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieves the description of the plugin.
	 *
	 * @since 0.1.0
	 *
	 * @return string The description of the plugin.
	 */
	public function get_plugin_description() {
		return $this->plugin_description;
	}

	/**
	 * Retrieve the current plugin version.
	 *
	 * @since 0.1.0
	 *
	 * @return string The current version of the plugin.
	 */
	public function get_plugin_version() {
		return $this->plugin_version;
	}
}
