<?php


/**
 * Project: ProjectPress
 * Description: ProjectPress is a simple and lightweight project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Website: https://www.stechbd.net/project/ProjectPress/
 * Developer: S Technologies
 * Homepage: https://www.stechbd.net
 * Contact: product@stechbd.net
 * Created: June 8, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\ProjectPress\Admin;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>' );
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
		$this->dispatch_actions();
		add_action( 'admin_menu', [$this, 'add_admin_menu'] );
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
		add_action( 'admin_init', [$settings, 'form_handler'] );
	}

	/**
	 * Method to add admin settings page in the sidebar menu.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function add_admin_menu(): void
	{
		add_menu_page( __( 'ProjectPress Settings', 'stechbd-projectpress' ), __( 'ProjectPress', 'stechbd-projectpress' ), 'manage_options', 'stechbd-projectpress', [$this, 'admin_index'], 'dashicons-admin-generic' );
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
		$settings->settings_page();
	}
}