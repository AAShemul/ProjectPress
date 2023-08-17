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


namespace STechBD\CookieCons\Frontend;
use STechBD\CookieCons\Asset;

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
	 * The class constructor method to enqueue styles and scripts.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		
		new Notice();
	}

	/**
	 * Method to load all the assets and enqueue the styles and scripts.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_scripts(): void
	{
	    new Asset();
	    
		wp_enqueue_style('st-cookiecons-style');
		wp_enqueue_script('jquery');
		wp_enqueue_script('st-cookiecons-script');
	}
}
