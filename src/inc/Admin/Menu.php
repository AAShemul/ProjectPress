<?php


/**
 * Project: CookieCons
 * Description: CookieCons is a simple and lightweight cookie consent plugin for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Website: https://www.stechbd.net/project/CookieCons/
 * Developer: S Technologies Limited
 * Homepage: https://www.stechbd.net
 * Contact: product@stechbd.net
 * Created: June 8, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\CookieCons\Admin;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if(!defined('ABSPATH'))
{
	die('<title>Access Denied | CookieCons by STechBD.Net</title><h1>CookieCons by STechBD.Net</h1><p>Access denied for security reasons.</p>');
}

/**
 * The admin panel class file.
 *
 * @since 1.0.0
 */
class Menu
{
	/**
	 * The class constructor method to dispatch actions and add an admin menu in the sidebar.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this -> dispatch_actions();
		add_action('admin_menu', [$this, 'add_admin_menu']);
	}

	/**
	 * Method to dispatch actions and handle form.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function dispatch_actions(): void
	{
		$settings = new Settings();
		add_action('admin_init', [$settings, 'form_handler']);
	}

	/**
	 * Method to add admin settings page in the sidebar menu.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function add_admin_menu(): void
	{
		add_menu_page(__('CookieCons Settings', 'stechbd-cookiecons'), __('CookieCons', 'stechbd-cookiecons'), 'manage_options', 'stechbd-cookiecons', [$this, 'admin_index'], 'dashicons-admin-generic');
	}

	/**
	 * Method to load admin settings page.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function admin_index(): void
	{
		$settings = new Settings();
		$settings -> settings_page();
	}
}