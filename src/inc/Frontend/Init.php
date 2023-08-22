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


namespace ProjectPress\Frontend;

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
	 * The class constructor method to enqueue styles and scripts.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_action( 'wp_head', [$this, 'head'] );
		add_action( 'wp_footer', [$this, 'footer'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
		add_action( 'wp_ajax_project_ajax', [$this, 'project_ajax'] );
		add_action( 'wp_ajax_nopriv_project_ajax', [$this, 'project_ajax'] );

		new Shortcode();
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

		wp_enqueue_style( 'projectpress-style' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'projectpress-script' );
	}

	/**
	 * Method to add HTML in the head tag.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function head(): void
	{
		// To be added later.
	}

	/**
	 * Method to add HTML in the footer tag.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function footer(): void
	{
		// To be added later.
	}

	/**
	 * Method to handle the AJAX actions.
	 *
	 * @return void Returns nothing.
	 */
	public function project_ajax(): void
	{
		/********* To be deleted ***********/
		/*if ( isset( $_POST['project_id'] ) && is_numeric( $_POST['project_id'] ) ) {
			$project_id = (int) $_POST['project_id'];

			// Get the project data
			$project = get_post( $project_id );

			// Get the project metadata
			$project_meta = get_post_meta( $project_id );

			// Get the project thumbnail
			$project_thumbnail = get_the_post_thumbnail_url( $project_id );

			// Example response
			$response = array (
				'title' => 'Project Title',
				'description' => 'Project Description',
				// ... other data
			);

			// Send the JSON response
			wp_send_json( $response );
		}

		// If the project ID is not provided or not valid
		wp_send_json_error( array ('error' => 'Invalid project ID.') );*/

		if ( check_ajax_referer( 'projectpress', 'security' && $_POST['action'] === 'project_ajax' ) ) {
			// Example response
			$response = array (
				'title' => 'Project Title',
				'description' => 'Project Description',
				// ... other data
			);

			// Send the JSON response
			wp_send_json( $response );
		} else {
			// If the project ID is not provided or not valid
			wp_send_json_error( array ('error' => 'Invalid project ID.') );
		}
	}
}
