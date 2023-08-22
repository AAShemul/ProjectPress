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
 * Updated: August 21, 2023
 */


namespace ProjectPress;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress</title><h1>ProjectPress</h1><p>Access is denied for security reasons.</p>' );
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
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->register();
	}

	/**
	 * Method to register all styles and scripts for future enqueuing.
	 *
	 * @return void Returns nothing.
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

		wp_localize_script( 'projectpress-script', 'ProjectPress', [
			'siteURL' => get_site_url() . '/',
			'restURL' => get_site_url() . '/wp-json/wp/v2/',
			'restPostURL' => get_site_url() . '/wp-json/wp/v2/posts/',
			'restMediaURL' => get_site_url() . '/wp-json/wp/v2/media/',
			'restProjectURL' => get_site_url() . '/wp-json/wp/v2/project/',
			'ajaxURL' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'projectpress' ),
		] );
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
				'projectpress-style' =>
					[
						'src' => PROJECTPRESS_SITE_CSS . 'projectpress.css',
						'dependency' => false,
						'version' => filemtime( PROJECTPRESS_CSS . 'projectpress.css' )
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
				'projectpress-script' =>
					[
						'src' => PROJECTPRESS_SITE_JS . 'projectpress.js',
						'dependency' => 'jquery',
						'version' => filemtime( PROJECTPRESS_JS . 'projectpress.js' )
					],
				'projectpress-admin-script' =>
					[
						'src' => PROJECTPRESS_SITE_JS . 'projectpress-admin.js',
						'dependency' => 'jquery',
						'version' => filemtime( PROJECTPRESS_JS . 'projectpress-admin.js' )
					],
			];
	}
}