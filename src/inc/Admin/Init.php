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
 * Created: June 17, 2023
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
class Init
{
	/**
	 * The class constructor method to load the Menu class.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct()
	{
		new Menu();
	}
}