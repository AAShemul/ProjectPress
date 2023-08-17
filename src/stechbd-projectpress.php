<?php


/**
 * Plugin Name: ProjectPress by STechBD.Net
 * Plugin URI: https://www.stechbd.net/project/ProjectPress/
 * Description: ProjectPress is a simple and lightweight project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: S Technologies Limited
 * Author URI: https://www.stechbd.net
 * Requires at least: 5.0.0
 * Tested up to: 6.2.2
 * Requires PHP: 8.0
 * Created: June 3, 2023
 * Updated: July 6, 2023
 * Text Domain: stechbd-projectpress
 * Domain Path: /languages
 * License: GPL v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */


/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
	die('<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access denied for security reasons.</p>');
}

/**
 * Constant definition for the plugin.
 *
 * @const string ST_PROJECTPRESS_PLUGIN           The absolute path of the plugin directory.
 * @const string ST_PROJECTPRESS_SITE             The URL of the website.
 * @const string ST_PROJECTPRESS_FILE             The absolute path of the current file.
 * @const string ST_PROJECTPRESS_INC              The path to the 'inc' directory within the plugin.
 * @const string ST_PROJECTPRESS_ADMIN            The path to the 'Admin' directory within the 'inc' directory.
 * @const string ST_PROJECTPRESS_FE               The path to the 'Frontend' directory within the 'inc' directory.
 * @const string ST_PROJECTPRESS_ASSETS           The absolute path of the 'asset' directory within the plugin.
 * @const string ST_PROJECTPRESS_CSS              The absolute path of the 'css' directory within the 'asset' directory.
 * @const string ST_PROJECTPRESS_JS               The absolute path of the 'js' directory within the 'asset' directory.
 * @const string ST_PROJECTPRESS_IMG              The absolute path of the 'img' directory within the 'asset' directory.
 * @const string ST_PROJECTPRESS_SITE_PLUGIN      The URL of the 'stechbd-projectpress' plugin directory on the site.
 * @const string ST_PROJECTPRESS_SITE_CSS         The URL of the 'css' directory within the 'stechbd-projectpress' plugin directory.
 * @const string ST_PROJECTPRESS_SITE_JS          The URL of the 'js' directory within the 'stechbd-projectpress' plugin directory.
 * @const string ST_PROJECTPRESS_VERSION          The version number of the plugin.
 * @const string ST_PROJECTPRESS_VERSION_CODE     The version code of the plugin.
 *
 * @since 1.0.0
 */


define('ST_PROJECTPRESS_PLUGIN', plugin_dir_path(__FILE__));
define('ST_PROJECTPRESS_SITE', home_url() . '/');
const ST_PROJECTPRESS_FILE = __FILE__;
const ST_PROJECTPRESS_DS = DIRECTORY_SEPARATOR;
const ST_PROJECTPRESS_INC = ST_PROJECTPRESS_PLUGIN . 'inc' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_ADMIN = ST_PROJECTPRESS_INC . 'Admin' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_FE = ST_PROJECTPRESS_INC . 'Frontend' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_ASSET = ST_PROJECTPRESS_PLUGIN . 'asset' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_CSS = ST_PROJECTPRESS_ASSET . 'css' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_JS = ST_PROJECTPRESS_ASSET . 'js' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_IMG = ST_PROJECTPRESS_ASSET . 'img' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_SITE_PLUGIN = ST_PROJECTPRESS_SITE . 'wp-content' . ST_PROJECTPRESS_DS . 'plugins' . ST_PROJECTPRESS_DS . 'stechbd-projectpress' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_SITE_CSS = ST_PROJECTPRESS_SITE_PLUGIN . 'asset' . ST_PROJECTPRESS_DS . 'css' . ST_PROJECTPRESS_DS;
const ST_PROJECTPRESS_SITE_JS = ST_PROJECTPRESS_SITE_PLUGIN . 'asset' . ST_PROJECTPRESS_DS . 'js' . ST_PROJECTPRESS_DS;

const ST_PROJECTPRESS_VERSION = '1.0.0';
const ST_PROJECTPRESS_VERSION_CODE = '1';

require_once(ST_PROJECTPRESS_INC . 'vendor' . ST_PROJECTPRESS_DS . 'autoload.php');


/**
 * Calling 'STechBD\ProjectPress\Main::init()' method to initialize the plugin.
 *
 * @return void
 * @since 1.0.0
 */
STechBD\ProjectPress\Main::init();