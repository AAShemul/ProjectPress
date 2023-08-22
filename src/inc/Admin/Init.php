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

use ProjectPress\Asset;

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
class Init
{
	/**
	 * The class constructor method to load the Menu class.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

		new Menu();
	}

	/**
	 * Method to load all the assets and enqueue the styles and scripts.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function enqueue_scripts(): void
	{
		new Asset();

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'projectpress-admin-script' );
	}
}