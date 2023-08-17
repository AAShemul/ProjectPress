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
 * Developer: S Technologies Limited
 * Homepage: https://www.stechbd.net
 * Contact: product@stechbd.net
 * Created: June 15, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\ProjectPress\Admin;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if(!defined('ABSPATH'))
{
	die('<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access denied for security reasons.</p>');
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
	 * @return void
	 * @since 1.0.0
	 */
	public function settings_page(): void
	{
		require_once ST_PROJECTPRESS_ADMIN . 'View/Settings.php';
	}

	/**
	 * Method to handle the submission from admin Settings page.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function form_handler(): void
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitNotice']))
		{
			if(!wp_verify_nonce($_POST['_wpnonce'], 'stechbd-projectpress'))
			{
				wp_die('<h1>ProjectPress by STechBD.Net</h1><p>Access denied for security reasons.</p>', 'ProjectPress Error');
			}

			if(!current_user_can('manage_options'))
			{
				wp_die('<h1>ProjectPress by STechBD.Net</h1><p>Access denied for security reasons.</p>', 'ProjectPress Error');
			}

			$notice = get_option('stechbd_projectpress_notice');
			$noticeVal = wp_unslash($_POST['notice']);

			if(!empty($noticeVal))
			{
				if($notice === $noticeVal)
				{
					add_settings_error('stechbd-projectpress', 'error', 'Same notice already exists!');
				}
				else
				{
					update_option('stechbd_projectpress_notice', $noticeVal);
					add_settings_error('stechbd-projectpress', 'success', 'Notice updated successfully!', 'updated');
				}
			}
			else
			{
				add_settings_error('stechbd-projectpress', 'error', 'Please insert a value!');
			}
		}
	}
}