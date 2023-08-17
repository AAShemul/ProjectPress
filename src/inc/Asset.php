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
 * Created: June 29, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\CookieCons;

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
 * The asset loader class.
 *
 * @since 1.0.0
 */
class Asset
{
	/**
	 * The class constructor method to call the register method.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct()
    {
        $this -> register();
    }

	/**
	 * Method to list all styles.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function style(): array
    {
        return 
        [
            'st-cookiecons-style'    =>    
            [
                'src'        =>    ST_COOKIECONS_SITE_CSS . 'stechbd-cookiecons.css',
                'dependency'    =>    false,
                'version'        =>    filemtime(ST_COOKIECONS_CSS . 'stechbd-cookiecons.css')
            ]
        ];
    }

	/**
	 * Method to list all scripts.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function script(): array
    {
        return 
        [
            'st-cookiecons-script'    =>    
            [
                'src'        =>    ST_COOKIECONS_SITE_JS . 'stechbd-cookiecons.js',
                'dependency'    =>    'jquery',
                'version'        =>    filemtime(ST_COOKIECONS_JS . 'stechbd-cookiecons.js')
            ]
        ];
    }

	/**
	 * Method to register all styles and scripts for future enqueuing.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void
    {
        $style = $this -> style();
        $script = $this -> script();
        
        
        foreach ($style as $name => $value)
        {
            wp_register_style($name, $value['src'], $value['dependency'], $value['version']);
        }
        
        foreach ($script as $name => $value)
        {
            wp_register_script($name, $value['src'], $value['dependency'], $value['version']);
        }
    }
}