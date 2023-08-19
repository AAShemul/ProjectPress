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
 * Created: June 29, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\ProjectPress;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>' );
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
		$this->register();
	}

	/**
	 * Method to register all styles and scripts for future enqueuing.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void
	{
		$style = $this->style();
		$script = $this->script();


		foreach ( $style as $name => $value ) {
			wp_register_style( $name, $value['src'], $value['dependency'], $value['version'] );
		}

		foreach ( $script as $name => $value ) {
			wp_register_script( $name, $value['src'], $value['dependency'], $value['version'] );
		}
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
				'st-projectpress-style' =>
					[
						'src' => ST_PROJECTPRESS_SITE_CSS . 'stechbd-projectpress.css',
						'dependency' => false,
						'version' => filemtime( ST_PROJECTPRESS_CSS . 'stechbd-projectpress.css' )
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
				'st-projectpress-script' =>
					[
						'src' => ST_PROJECTPRESS_SITE_JS . 'stechbd-projectpress.js',
						'dependency' => 'jquery',
						'version' => filemtime( ST_PROJECTPRESS_JS . 'stechbd-projectpress.js' )
					]
			];
	}
}