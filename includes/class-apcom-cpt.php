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
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
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
	 * Register a Thematic custom post type.
	 *
	 * @since 0.1.0
	 */
	private function register_thematic_post_type() {
		$singular_name = __( 'Thematic', 'APComCPT' );
		$plural_name   = __( 'Thematics', 'APComCPT' );
		$description   = __( 'Thematic custom post type.', 'APComCPT' );
		$icon          = 'dashicons-category';

		$thematic_cpt = new CPT( $singular_name, $plural_name, $description, $icon, 5 );
		$thematic_cpt->init();
	}

	/**
	 * Register a Topic custom post type.
	 *
	 * @since 0.1.0
	 */
	private function register_topic_post_type() {
		$singular_name = __( 'Topic', 'APComCPT' );
		$plural_name   = __( 'Topics', 'APComCPT' );
		$description   = __( 'Topic custom post type.', 'APComCPT' );
		$icon          = 'dashicons-tag';

		$topic_cpt = new CPT( $singular_name, $plural_name, $description, $icon, 6 );
		$topic_cpt->init();
	}

	/**
	 * Update permalinks.
	 *
	 * @since 0.1.0
	 */
	private function update_permalinks() {
		flush_rewrite_rules();
	}

	/**
	 * Fires when the plugin is activated.
	 *
	 * @since 0.1.0
	 */
	public function activate() {
		$this->register_thematic_post_type();
		$this->register_topic_post_type();
		$this->update_permalinks();
	}

	/**
	 * Fires when the plugin is deactivated.
	 *
	 * @since 0.1.0
	 */
	public function deactivate() {
		$this->update_permalinks();
	}

	/**
	 * Execute the plugin.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		$this->set_locale();
		$this->register_thematic_post_type();
		$this->register_topic_post_type();
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
