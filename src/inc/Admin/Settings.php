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
 * Updated: August 22, 2023
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
 * The admin page class file.
 *
 * @since 1.0.0
 */
class Settings
{
	/**
	 * Method to load the Settings page view.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function settings_page(): void
	{
		require_once PROJECTPRESS_ADMIN . 'View/Settings.php';
	}

	/**
	 * Method to handle the submission from admin Settings page.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function form_handler(): void
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['submitProjectPress'] ) ) {
			if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'projectpress' ) ) {
				wp_die( '<h1>ProjectPress</h1><p>Access is denied for security reasons.</p>', 'ProjectPress Error' );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( '<h1>ProjectPress</h1><p>Access is denied for security reasons.</p>', 'ProjectPress Error' );
			}

			$delete = get_option( 'stechbd_projectpress_delete_projects' );
			$deleteVal = $_POST['delete_projects'];

			if ( ! empty( $deleteVal ) ) {
				if ( $delete === $deleteVal ) {
					add_settings_error( 'projectpress', 'error', 'Same valur already exists!' );
				} else {
					update_option( 'stechbd_projectpress_delete_projects', $deleteVal );
					add_settings_error( 'projectpress', 'success', 'Setting value updated successfully!', 'updated' );
				}
			} else {
				add_settings_error( 'projectpress', 'error', 'Please select an option!' );
			}
		}
	}
}