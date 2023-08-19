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
 * The main plugin class.
 *
 * @since 1.0.0
 */
class Main
{
	/**
	 * The class constructor method to register activation and deactivation hooks and to load the 'init_plugin' method.
	 *
	 * It is prevented from being called more than once by using the 'singleton' design pattern.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function __construct()
	{
		register_activation_hook( ST_PROJECTPRESS_FILE, [$this, 'activate'] );
		register_deactivation_hook( ST_PROJECTPRESS_FILE, [$this, 'deactivate'] );
		add_action( 'plugins_loaded', [$this, 'init_plugin'] );

		add_action( 'init', [$this, 'custom_post_type_project'], 0 );
		add_action( 'init', [$this, 'custom_taxonomy_project_category'], 0 );
		add_action( 'init', [$this, 'custom_taxonomy_project_tag'], 0 );
	}

	/**
	 * Method to initialize the plugin and to load the class constructor method.
	 *
	 * @return Main The class instance.
	 * @since 1.0.0
	 */
	public static function init(): Main
	{
		$instance = null;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Method to run plugin activation activities.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function activate(): void
	{
		$installed = get_option( 'stechbd_projectpress_installed' );

		if ( ! $installed ) {
			update_option( 'stechbd_projectpress_installed', time() );
		}

		update_option( 'stechbd_projectpress_version', ST_PROJECTPRESS_VERSION );
		update_option( 'stechbd_projectpress_version_code', ST_PROJECTPRESS_VERSION_CODE );
	}

	/**
	 * Method to run plugin deactivation activities.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function deactivate(): void
	{
		// To be added later.
	}

	/**
	 * Method to initialize the plugin.
	 *
	 * It loads the Admin\Init class if the user is in the admin panel, otherwise it loads the Frontend\Init class.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function init_plugin(): void
	{
		if ( is_admin() ) {
			new Admin\Init();
		} else {
			new Frontend\Init();
		}
	}

	/**
	 * Method to register a custom post type.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function custom_post_type_project(): void
	{
		$labels = array (
			'name' => _x( 'Projects', 'Post Type General Name', 'stechbd-projectpress' ),
			'singular_name' => _x( 'Project', 'Post Type Singular Name', 'stechbd-projectpress' ),
			'add_new' => __( 'Add New', 'stechbd-projectpress' ),
			'add_new_item' => __( 'Add New Project', 'stechbd-projectpress' ),
			'edit_item' => __( 'Edit Project', 'stechbd-projectpress' ),
			'new_item' => __( 'New Project', 'stechbd-projectpress' ),
			'view_item' => __( 'View Project', 'stechbd-projectpress' ),
			'search_items' => __( 'Search Project', 'stechbd-projectpress' ),
			'not_found' => __( 'Not found', 'stechbd-projectpress' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'stechbd-projectpress' ),
			'menu_name' => __( 'Projects', 'stechbd-projectpress' ),
			'all_items' => __( 'All Projects', 'stechbd-projectpress' ),
			'featured_image' => __( 'Thumbnail', 'stechbd-projectpress' ),
			'set_featured_image' => __( 'Set thumbnail', 'stechbd-projectpress' ),
			'remove_featured_image' => __( 'Remove thumbnail', 'stechbd-projectpress' ),
			'use_featured_image' => __( 'Use as thumbnail', 'stechbd-projectpress' ),
			'name_admin_bar' => __( 'Project', 'stechbd-projectpress' ),
			'archives' => __( 'Project Archives', 'stechbd-projectpress' ),
			'attributes' => __( 'Project Attributes', 'stechbd-projectpress' ),
			'parent_item_colon' => __( 'Parent Project:', 'stechbd-projectpress' ),
			'update_item' => __( 'Update Project', 'stechbd-projectpress' ),
			'view_items' => __( 'View Projects', 'stechbd-projectpress' ),
			'insert_into_item' => __( 'Insert into project', 'stechbd-projectpress' ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', 'stechbd-projectpress' ),
			'items_list' => __( 'Projects list', 'stechbd-projectpress' ),
			'items_list_navigation' => __( 'Projects list navigation', 'stechbd-projectpress' ),
			'filter_items_list' => __( 'Filter projects list', 'stechbd-projectpress' ),
		);

		$args = array (
			'labels' => $labels,
			'public' => true,
			'supports' => array ('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
			'label' => __( 'Project', 'stechbd-projectpress' ),
			'description' => __( 'Project listing.', 'stechbd-projectpress' ),
			'menu_icon' => 'dashicons-portfolio',
			'post_type' => 'project',
			'has_archive' => true,
		);

		register_post_type( 'project', $args );

		register_meta( 'project', 'link', array (
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'auth_callback' => null,
		) );

		register_meta( 'project', 'image', array (
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'auth_callback' => null,
		) );
	}

	public function custom_taxonomy_project_category(): void
	{
		$labels = array (
			'name' => _x( 'Project Categories', 'taxonomy general name', 'stechbd-projectpress' ),
			'singular_name' => _x( 'Project Category', 'taxonomy singular name', 'stechbd-projectpress' ),
			'search_items' => __( 'Search Project Categories', 'stechbd-projectpress' ),
			'all_items' => __( 'All Project Categories', 'stechbd-projectpress' ),
			'parent_item' => __( 'Parent Project Category', 'stechbd-projectpress' ),
			'parent_item_colon' => __( 'Parent Project Category:', 'stechbd-projectpress' ),
			'edit_item' => __( 'Edit Project Category', 'stechbd-projectpress' ),
			'update_item' => __( 'Update Project Category', 'stechbd-projectpress' ),
			'add_new_item' => __( 'Add New Project Category', 'stechbd-projectpress' ),
			'new_item_name' => __( 'New Project Category Name', 'stechbd-projectpress' ),
			'menu_name' => __( 'Project Categories', 'stechbd-projectpress' ),
		);

		$args = array (
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array ('slug' => 'project-category'),
		);

		register_taxonomy( 'project_category', array ('project'), $args );
	}

	public function custom_taxonomy_project_tag(): void
	{
		$labels = array (
			'name' => _x( 'Project Tags', 'taxonomy general name', 'stechbd-projectpress' ),
			'singular_name' => _x( 'Project Tag', 'taxonomy singular name', 'stechbd-projectpress' ),
			'search_items' => __( 'Search Project Tags', 'stechbd-projectpress' ),
			'all_items' => __( 'All Project Tags', 'stechbd-projectpress' ),
			'parent_item' => __( 'Parent Project Tag', 'stechbd-projectpress' ),
			'parent_item_colon' => __( 'Parent Project Tag:', 'stechbd-projectpress' ),
			'edit_item' => __( 'Edit Project Tag', 'stechbd-projectpress' ),
			'update_item' => __( 'Update Project Tag', 'stechbd-projectpress' ),
			'add_new_item' => __( 'Add New Project Tag', 'stechbd-projectpress' ),
			'new_item_name' => __( 'New Project Tag Name', 'stechbd-projectpress' ),
			'menu_name' => __( 'Project Tags', 'stechbd-projectpress' ),
		);

		$args = array (
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array ('slug' => 'project-tag'),
		);

		register_taxonomy( 'project_tag', array ('project'), $args );
	}
}