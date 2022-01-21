<?php
/**
 * APcom-CPT
 *
 * Custom post types for my personal website.
 *
 * @package   APcom-CPT
 * @link      https://github.com/ArmandPhilippot/apcom-cpt
 * @author    Armand Philippot <contact@armandphilippot.com>
 *
 * @copyright 2022 Armand Philippot
 * @license   GPL-2.0-or-later
 * @since     0.1.0
 *
 * @wordpress-plugin
 * Plugin Name:       APcom CPT
 * Plugin URI:        https://github.com/ArmandPhilippot/apcom-cpt
 * Description:       Custom post types for my personal website.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Armand Philippot
 * Author URI:        https://www.armandphilippot.com/
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       APcomCPT
 * Domain Path:       /languages
 */

namespace APcom_CPT;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Currently plugin version.
 * Start at version 0.1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'APCOM_CPT_VERSION', '0.1.0' );

/**
 * The core plugin class that is used to define internationalization and custom
 * post types registration.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-apcom-cpt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks, then kicking off
 * the plugin from this point in the file does not affect the page life cycle.
 *
 * @since 0.1.0
 */
function apcom_cpt_run() {
	$plugin = new APcom_CPT();
	$plugin->run();
}
apcom_cpt_run();
