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

		add_action( 'init', [$this, 'custom_post_type_portfolio'], 0 );
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
	public function custom_post_type_portfolio(): void
	{
		$labels = array(
			'name'                  => _x( 'All Projects', 'Post Type General Name', 'stechbd-projectpress' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'stechbd-projectpress' ),
			'add_new'               => __( 'Add New', 'stechbd-projectpress' ),
			'add_new_item'          => __( 'Add New Project', 'stechbd-projectpress' ),
			'edit_item'             => __( 'Edit Project', 'stechbd-projectpress' ),
			'new_item'              => __( 'New Project', 'stechbd-projectpress' ),
			'view_item'             => __( 'View Project', 'stechbd-projectpress' ),
			'search_items'          => __( 'Search Project', 'stechbd-projectpress' ),
			'not_found'             => __( 'Not found', 'stechbd-projectpress' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'stechbd-projectpress' ),
			'menu_name'             => __( 'Projects', 'stechbd-projectpress' ),

//			'name_admin_bar'        => __( 'Project', 'stechbd-projectpress' ),
//			'archives'              => __( 'Project Archives', 'stechbd-projectpress' ),
//			'attributes'            => __( 'Project Attributes', 'stechbd-projectpress' ),
//			'parent_item_colon'     => __( 'Parent Project:', 'stechbd-projectpress' ),
//			'all_items'             => __( 'All Projects', 'stechbd-projectpress' ),
//			'update_item'           => __( 'Update Project', 'stechbd-projectpress' ),
//			'view_items'            => __( 'View Projects', 'stechbd-projectpress' ),
//			'featured_image'        => __( 'Featured Image', 'stechbd-projectpress' ),
//			'set_featured_image'    => __( 'Set featured image', 'stechbd-projectpress' ),
//			'remove_featured_image' => __( 'Remove featured image', 'stechbd-projectpress' ),
//			'use_featured_image'    => __( 'Use as featured image', 'stechbd-projectpress' ),
//			'insert_into_item'      => __( 'Insert into project', 'stechbd-projectpress' ),
//			'uploaded_to_this_item' => __( 'Uploaded to this project', 'stechbd-projectpress' ),
//			'items_list'            => __( 'Projects list', 'stechbd-projectpress' ),
//			'items_list_navigation' => __( 'Projects list navigation', 'stechbd-projectpress' ),
//			'filter_items_list'     => __( 'Filter projects list', 'stechbd-projectpress' ),
		);

		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'label'                 => __( 'Portfolio', 'stechbd-projectpress' ),
			'description'           => __( 'Post Type Description', 'stechbd-projectpress' ),
			'menu_icon'             => 'dashicons-portfolio',


//			'taxonomies'            => array( 'category', 'post_tag' ),
//			'hierarchical'          => false,
//			'show_ui'               => true,
//			'show_in_menu'          => true,
//			'menu_position'         => 5,
//			'show_in_admin_bar'     => true,
//			'show_in_nav_menus'     => true,
//			'can_export'            => true,
//			'has_archive'           => true,
//			'exclude_from_search'   => false,
//			'publicly_queryable'    => true,
//			'capability_type'       => 'post',
		);
		
		register_post_type( 'portfolio', $args );
	}
}