<?php


/**
 * Plugin Name: ProjectPress
 * Plugin URI: https://github.com/AAShemul/ProjectPress/
 * Description: ProjectPress is a lightweight and beautiful project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Author URI: https://github.com/AAShemul
 * Requires at least: 5.0.0
 * Tested up to: 6.2.2
 * Requires PHP: 8.0
 * Created: August 17, 2023
 * Updated: August 17, 2023
 * Text Domain: projectpress
 * Domain Path: /languages
 * License: GPL v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */


/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress</title><h1>ProjectPress</h1><p>Access is denied for security reasons.</p>' );
}

/**
 * Constant definition for the plugin.
 *
 * @const string PROJECTPRESS_PLUGIN           The absolute path of the plugin directory.
 * @const string PROJECTPRESS_SITE             The URL of the website.
 * @const string PROJECTPRESS_FILE             The absolute path of the current file.
 * @const string PROJECTPRESS_INC              The path to the 'inc' directory within the plugin.
 * @const string PROJECTPRESS_ADMIN            The path to the 'Admin' directory within the 'inc' directory.
 * @const string PROJECTPRESS_FE               The path to the 'Frontend' directory within the 'inc' directory.
 * @const string PROJECTPRESS_ASSETS           The absolute path of the 'asset' directory within the plugin.
 * @const string PROJECTPRESS_CSS              The absolute path of the 'css' directory within the 'asset' directory.
 * @const string PROJECTPRESS_JS               The absolute path of the 'js' directory within the 'asset' directory.
 * @const string PROJECTPRESS_IMG              The absolute path of the 'img' directory within the 'asset' directory.
 * @const string PROJECTPRESS_SITE_PLUGIN      The URL of the 'projectpress' plugin directory on the site.
 * @const string PROJECTPRESS_SITE_CSS         The URL of the 'css' directory within the 'projectpress' plugin directory.
 * @const string PROJECTPRESS_SITE_JS          The URL of the 'js' directory within the 'projectpress' plugin directory.
 * @const string PROJECTPRESS_VERSION          The version number of the plugin.
 * @const string PROJECTPRESS_VERSION_CODE     The version code of the plugin.
 *
 * @since 1.0.0
 */
define( 'PROJECTPRESS_PLUGIN', plugin_dir_path( __FILE__ ) );
define( 'PROJECTPRESS_SITE', home_url() . '/' );
const PROJECTPRESS_FILE = __FILE__;
const PROJECTPRESS_DS = DIRECTORY_SEPARATOR;
const PROJECTPRESS_INC = PROJECTPRESS_PLUGIN . 'inc' . PROJECTPRESS_DS;
const PROJECTPRESS_ADMIN = PROJECTPRESS_INC . 'Admin' . PROJECTPRESS_DS;
const PROJECTPRESS_FE = PROJECTPRESS_INC . 'Frontend' . PROJECTPRESS_DS;
const PROJECTPRESS_ASSET = PROJECTPRESS_PLUGIN . 'asset' . PROJECTPRESS_DS;
const PROJECTPRESS_CSS = PROJECTPRESS_ASSET . 'css' . PROJECTPRESS_DS;
const PROJECTPRESS_JS = PROJECTPRESS_ASSET . 'js' . PROJECTPRESS_DS;
const PROJECTPRESS_IMG = PROJECTPRESS_ASSET . 'img' . PROJECTPRESS_DS;
const PROJECTPRESS_SITE_PLUGIN = PROJECTPRESS_SITE . 'wp-content/plugins/projectpress/';
const PROJECTPRESS_SITE_CSS = PROJECTPRESS_SITE_PLUGIN . 'asset/css/';
const PROJECTPRESS_SITE_JS = PROJECTPRESS_SITE_PLUGIN . 'asset/js/';
const PROJECTPRESS_VERSION = '1.0.0';
const PROJECTPRESS_VERSION_CODE = '1';

require_once( PROJECTPRESS_INC . 'vendor' . PROJECTPRESS_DS . 'autoload.php' );

/**
 * Calling 'ProjectPress\Main::init()' method to initialize the plugin.
 *
 * @return void
 * @since 1.0.0
 */
ProjectPress\Main::init();