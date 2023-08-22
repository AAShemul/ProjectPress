<?php


/**
 * Project: ProjectPress
 * Description: ProjectPress is a lightweight and beautiful project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Created: August 17, 2023
 * Updated: August 17, 2023
 */


namespace ProjectPress\Admin;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress</title><h1>ProjectPress</h1><p>Access is denied for security reasons.</p>' );
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
	 * @return void Returns nothing.
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
	 * @return void Returns nothing.
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
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function add_admin_menu(): void
	{
		add_menu_page( __( 'ProjectPress Settings', 'projectpress' ), __( 'ProjectPress', 'projectpress' ), 'manage_options', 'projectpress', [$this, 'admin_index'], 'dashicons-admin-generic' );
	}

	/**
	 * Method to load admin settings page.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function admin_index(): void
	{
		$settings = new Settings();
		$settings->settings_page();
	}
}