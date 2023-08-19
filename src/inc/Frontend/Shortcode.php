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
 * Updated: July 6, 2023
 */


namespace STechBD\ProjectPress\Frontend;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>' );
}

/**
 * The frontend shortcut class file.
 *
 * @since 1.0.0
 */
class Shortcode
{
	/**
	 * The class constructor method to put shortcode in the 'wp_head' hook.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_shortcode( 'ProjectPress', [$this, 'render'] );
	}

	/**
	 * Method to load the shortcode view file.
	 *
	 * @param mixed|null $attributes
	 * @param mixed|null $content
	 * @return string
	 * @since 1.0.0
	 */
	public function render( mixed $attributes = null, mixed $content = null ): string
	{
		return 'ProjectPress Shortcode';
	}
}