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
 * Created: August 17, 2023
 * Updated: August 22, 2023
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
		require_once ST_PROJECTPRESS_ADMIN . 'View/Settings.php';
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
			if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'stechbd-projectpress' ) ) {
				wp_die( '<h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>', 'ProjectPress Error' );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( '<h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>', 'ProjectPress Error' );
			}

			$delete = get_option( 'stechbd_projectpress_delete_projects' );
			$deleteVal = $_POST['delete_projects'];

			if ( ! empty( $deleteVal ) ) {
				if ( $delete === $deleteVal ) {
					add_settings_error( 'stechbd-projectpress', 'error', 'Same valur already exists!' );
				} else {
					update_option( 'stechbd_projectpress_delete_projects', $deleteVal );
					add_settings_error( 'stechbd-projectpress', 'success', 'Setting value updated successfully!', 'updated' );
				}
			} else {
				add_settings_error( 'stechbd-projectpress', 'error', 'Please select an option!' );
			}
		}
	}
}