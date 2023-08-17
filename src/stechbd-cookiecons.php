<?php


/**
 * Plugin Name: CookieCons by STechBD.Net
 * Plugin URI: https://www.stechbd.net/project/CookieCons/
 * Description: CookieCons is a simple and lightweight cookie consent plugin for WordPress.
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
 * Text Domain: stechbd-cookiecons
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
	die('<title>Access Denied | CookieCons by STechBD.Net</title><h1>CookieCons by STechBD.Net</h1><p>Access denied for security reasons.</p>');
}

/**
 * Constants definition for the plugin.
 *
 * @const string ST_COOKIECONS_PLUGIN           The absolute path of the plugin directory.
 * @const string ST_COOKIECONS_SITE             The URL of the website.
 * @const string ST_COOKIECONS_FILE             The absolute path of the current file.
 * @const string ST_COOKIECONS_INC              The path to the 'inc' directory within the plugin.
 * @const string ST_COOKIECONS_ADMIN            The path to the 'Admin' directory within the 'inc' directory.
 * @const string ST_COOKIECONS_FE               The path to the 'Frontend' directory within the 'inc' directory.
 * @const string ST_COOKIECONS_ASSETS           The absolute path of the 'asset' directory within the plugin.
 * @const string ST_COOKIECONS_CSS              The absolute path of the 'css' directory within the 'asset' directory.
 * @const string ST_COOKIECONS_JS               The absolute path of the 'js' directory within the 'asset' directory.
 * @const string ST_COOKIECONS_IMG              The absolute path of the 'img' directory within the 'asset' directory.
 * @const string ST_COOKIECONS_SITE_PLUGIN      The URL of the 'stechbd-cookiecons' plugin directory on the site.
 * @const string ST_COOKIECONS_SITE_CSS         The URL of the 'css' directory within the 'stechbd-cookiecons' plugin directory.
 * @const string ST_COOKIECONS_SITE_JS          The URL of the 'js' directory within the 'stechbd-cookiecons' plugin directory.
 * @const string ST_COOKIECONS_VERSION          The version number of the plugin.
 * @const string ST_COOKIECONS_VERSION_CODE     The version code of the plugin.
 *
 * @since 1.0.0
 */


define('ST_COOKIECONS_PLUGIN', plugin_dir_path(__FILE__));
define('ST_COOKIECONS_SITE', home_url() . '/');
const ST_COOKIECONS_FILE = __FILE__;
const ST_COOKIECONS_INC = ST_COOKIECONS_PLUGIN . 'inc/';
const ST_COOKIECONS_ADMIN = ST_COOKIECONS_INC . 'Admin/';
const ST_COOKIECONS_FE = ST_COOKIECONS_INC . 'Frontend/';
const ST_COOKIECONS_ASSET = ST_COOKIECONS_PLUGIN . 'asset/';
const ST_COOKIECONS_CSS = ST_COOKIECONS_ASSET . 'css/';
const ST_COOKIECONS_JS = ST_COOKIECONS_ASSET . 'js/';
const ST_COOKIECONS_IMG = ST_COOKIECONS_ASSET . 'img/';
const ST_COOKIECONS_SITE_PLUGIN = ST_COOKIECONS_SITE . 'wp-content/plugins/stechbd-cookiecons/';
const ST_COOKIECONS_SITE_CSS = ST_COOKIECONS_SITE_PLUGIN . 'asset/css/';
const ST_COOKIECONS_SITE_JS = ST_COOKIECONS_SITE_PLUGIN . 'asset/js/';

const ST_COOKIECONS_VERSION = '1.0.0';
const ST_COOKIECONS_VERSION_CODE = '1';

require_once ST_COOKIECONS_INC . 'inc.php';


/**
 * Calling 'STechBD\CookieCons\Main::init()' method to initialize the plugin.
 *
 * @return void
 * @since 1.0.0
 */
STechBD\CookieCons\Main::init();