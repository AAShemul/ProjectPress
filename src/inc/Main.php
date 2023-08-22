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
 * Updated: August 22, 2023
 */


namespace ProjectPress;

use Throwable;
use WP_Query;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress</title><h1>ProjectPress</h1><p>Access is denied for security reasons.</p>' );
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
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	private function __construct()
	{
		register_activation_hook( PROJECTPRESS_FILE, [$this, 'activate'] );
		register_deactivation_hook( PROJECTPRESS_FILE, [$this, 'deactivate'] );
		add_action( 'plugins_loaded', [$this, 'init_plugin'] );

		add_filter( 'use_block_editor_for_post_type', [$this, 'disable_block_editor'], 10, 2 );

		add_action( 'init', [$this, 'custom_post_type_project'], 0 );
		add_action( 'init', [$this, 'custom_taxonomy_project_category'], 0 );
		add_action( 'init', [$this, 'custom_taxonomy_project_tag'], 0 );
		add_action( 'rest_api_init', [$this, 'register_rest_field'] );
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
	 * @return void Returns nothing.
	 * @throws Throwable
	 * @since 1.0.0
	 */
	public function activate(): void
	{
		/**
		 * Check and update options for the plugin.
		 *
		 * @since 1.0.0
		 */
		$installed = get_option( 'stechbd_projectpress_installed' );

		if ( ! $installed ) {
			update_option( 'stechbd_projectpress_installed', time() );
		}

		update_option( 'stechbd_projectpress_version', PROJECTPRESS_VERSION );
		update_option( 'stechbd_projectpress_version_code', PROJECTPRESS_VERSION_CODE );
		update_option( 'stechbd_projectpress_delete_projects', 'false' );

		/**
		 * Create the projects showcase page for the plugin.
		 *
		 * @since 1.0.0
		 */
		$slug = wp_unique_post_slug( sanitize_title( 'projects' ), 0, 'publish', 'page', 0 );

		if ( ! empty( $slug ) ) {
			$page_data = array (
				'post_title' => 'Projects',
				'post_content' => '[ProjectPress]',
				'post_status' => 'publish',
				'post_author' => get_current_user_id(),
				'post_type' => 'page',
				'post_name' => $slug,
			);

			try {
				$page_id = wp_insert_post( $page_data );
				update_option( 'stechbd_projectpress_page_id', $page_id );
			} catch ( Throwable $error ) {
				add_settings_error( 'projectpress', 'error', 'Project page couldn\'t create. Please create it manually with content of "[ProjectPress]" shortcode.' );
			}
		}
	}

	/**
	 * Method to run plugin deactivation activities.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function deactivate(): void
	{
		/**
		 * Delete all the projects and taxonomies on plugin deactivation.
		 * The option is set from the admin Settings page.
		 *
		 * @since 1.0.0
		 */
		$option = get_option( 'stechbd_projectpress_delete_projects' );

		if ( $option === 'true' ) {
			$args = array (
				'post_type' => 'project',
				'posts_per_page' => -1,
			);

			$projects_query = new WP_Query( $args );

			if ( $projects_query->have_posts() ) {
				while ( $projects_query->have_posts() ) {
					$projects_query->the_post();
					$post_id = get_the_ID();
					wp_delete_post( $post_id, true );
				}
			}

			$categories = get_terms( array (
				'taxonomy' => 'project_category',
				'hide_empty' => false,
			) );

			foreach ( $categories as $category ) {
				wp_delete_term( $category->term_id, 'project_category' );
			}

			$tags = get_terms( array (
				'taxonomy' => 'project_tag',
				'hide_empty' => false,
			) );

			foreach ( $tags as $tag ) {
				wp_delete_term( $tag->term_id, 'project_tag' );
			}
		}

		delete_option( 'stechbd_projectpress_delete_projects' );

		/**
		 * Delete the projects showcase page.
		 *
		 * @since 1.0.0
		 */
		$page_id = get_option( 'stechbd_projectpress_page_id' );

		if ( ! empty( $page_id ) ) {
			wp_delete_post( $page_id, true );
		}

		delete_option( 'stechbd_projectpress_page_id' );
	}

	/**
	 * Method to initialize the plugin.
	 *
	 * It loads the Admin\Init class if the user is in the admin panel, otherwise it loads the Frontend\Init class.
	 *
	 * @return void Returns nothing.
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
	 * Method to disable block editor for the 'project' post type.
	 *
	 * @param $use_block_editor
	 * @param $post_type
	 * @return false|mixed
	 * @since 1.0.0
	 */
	public function disable_block_editor( $use_block_editor, $post_type ): mixed
	{
		if ( $post_type === 'project' ) {
			return false;
		}

		return $use_block_editor;
	}

	/**
	 * Method to register a custom post type.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function custom_post_type_project(): void
	{
		$labels = array (
			'name' => _x( 'Projects', 'Post Type General Name', 'projectpress' ),
			'singular_name' => _x( 'Project', 'Post Type Singular Name', 'projectpress' ),
			'add_new' => __( 'Add New', 'projectpress' ),
			'add_new_item' => __( 'Add New Project', 'projectpress' ),
			'edit_item' => __( 'Edit Project', 'projectpress' ),
			'new_item' => __( 'New Project', 'projectpress' ),
			'view_item' => __( 'View Project', 'projectpress' ),
			'search_items' => __( 'Search Project', 'projectpress' ),
			'not_found' => __( 'Not found', 'projectpress' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'projectpress' ),
			'menu_name' => __( 'Projects', 'projectpress' ),
			'all_items' => __( 'All Projects', 'projectpress' ),
			'featured_image' => __( 'Thumbnail', 'projectpress' ),
			'set_featured_image' => __( 'Set thumbnail', 'projectpress' ),
			'remove_featured_image' => __( 'Remove thumbnail', 'projectpress' ),
			'use_featured_image' => __( 'Use as thumbnail', 'projectpress' ),
			'name_admin_bar' => __( 'Project', 'projectpress' ),
			'archives' => __( 'Project Archives', 'projectpress' ),
			'attributes' => __( 'Project Attributes', 'projectpress' ),
			'parent_item_colon' => __( 'Parent Project:', 'projectpress' ),
			'update_item' => __( 'Update Project', 'projectpress' ),
			'view_items' => __( 'View Projects', 'projectpress' ),
			'insert_into_item' => __( 'Insert into project', 'projectpress' ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', 'projectpress' ),
			'items_list' => __( 'Projects list', 'projectpress' ),
			'items_list_navigation' => __( 'Projects list navigation', 'projectpress' ),
			'filter_items_list' => __( 'Filter projects list', 'projectpress' ),
		);

		$args = array (
			'labels' => $labels,
			'public' => true,
			'supports' => array ('title', 'editor', 'thumbnail', 'excerpt', 'author', 'page-attributes'),
			'label' => __( 'Project', 'projectpress' ),
			'description' => __( 'Project listing.', 'projectpress' ),
			'menu_icon' => 'dashicons-portfolio',
			'post_type' => 'project',
			'has_archive' => true,
			'show_in_rest' => true,
		);

		register_post_type( 'project', $args );

		add_action( 'add_meta_boxes', [$this, 'add_custom_fields_metabox'] );
		add_action( 'save_post', [$this, 'save_custom_fields_metabox'] );
	}

	public function custom_taxonomy_project_category(): void
	{
		$labels = array (
			'name' => _x( 'Project Categories', 'taxonomy general name', 'projectpress' ),
			'singular_name' => _x( 'Project Category', 'taxonomy singular name', 'projectpress' ),
			'search_items' => __( 'Search Project Categories', 'projectpress' ),
			'all_items' => __( 'All Project Categories', 'projectpress' ),
			'parent_item' => __( 'Parent Project Category', 'projectpress' ),
			'parent_item_colon' => __( 'Parent Project Category:', 'projectpress' ),
			'edit_item' => __( 'Edit Project Category', 'projectpress' ),
			'update_item' => __( 'Update Project Category', 'projectpress' ),
			'add_new_item' => __( 'Add New Project Category', 'projectpress' ),
			'new_item_name' => __( 'New Project Category Name', 'projectpress' ),
			'menu_name' => __( 'Project Categories', 'projectpress' ),
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
			'name' => _x( 'Project Tags', 'taxonomy general name', 'projectpress' ),
			'singular_name' => _x( 'Project Tag', 'taxonomy singular name', 'projectpress' ),
			'search_items' => __( 'Search Project Tags', 'projectpress' ),
			'all_items' => __( 'All Project Tags', 'projectpress' ),
			'parent_item' => __( 'Parent Project Tag', 'projectpress' ),
			'parent_item_colon' => __( 'Parent Project Tag:', 'projectpress' ),
			'edit_item' => __( 'Edit Project Tag', 'projectpress' ),
			'update_item' => __( 'Update Project Tag', 'projectpress' ),
			'add_new_item' => __( 'Add New Project Tag', 'projectpress' ),
			'new_item_name' => __( 'New Project Tag Name', 'projectpress' ),
			'menu_name' => __( 'Project Tags', 'projectpress' ),
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

	/**
	 * Method to add a custom fields metabox to the project custom post type.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function add_custom_fields_metabox(): void
	{
		add_meta_box(
			'project-custom-fields',       // Unique ID for the meta box
			'Project Custom Fields',       // Title of the meta box
			[$this, 'render_custom_fields_metabox'], // Callback function to render the metabox content
			'project',                     // Post type to add the metabox to
			'normal',                      // Context (normal, advanced, side)
			'high'                         // Priority (high, core, default, low)
		);
	}

	/**
	 * Method to render the custom fields metabox content.
	 *
	 * @param mixed $post The post object.
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function render_custom_fields_metabox( mixed $post ): void
	{
		$link_value = get_post_meta( $post->ID, 'link', true );
		$image_value = get_post_meta( $post->ID, 'image', true );

		echo '<div class="form-field form-required term-name-wrap">
					<label for="project-link">Project URL</label>
					<input name="project_link" id="project-link" type="text" aria-required="true" aria-describedby="project-link-description" value="' . esc_attr( $link_value ) . '">
					<p id="project-link-description">The url of an external link for the project.</p>
				</div>';

		echo '<div class="form-field form-required term-name-wrap">
					<label for="project-image">Image URL</label> | <a href="#" class="projectpress-upload">Upload image</a>
					<input name="project_image" id="project-image" type="text" aria-required="true" aria-describedby="project-image-description" value="' . esc_attr( $image_value ) . '">
					<p id="project-image-description">The url of an image for the project.</p>
				</div>';

		echo '<div class="form-field form-required term-name-wrap">
					<label for="project-image-preview">Image Preview</label>
					<div id="project-image-preview" class="projectpress-image-preview">
						<img src="' . ( esc_attr( $image_value ) ?? 'https://snapbuilder.com/code_snippet_generator/image_placeholder_generator/1000x600/007730/DDDDDD/No-image' ) . '" width="50%" height="50%" style="object-fit: cover; object-position: center;" alt="Preview">
					</div>
				</div>';

		echo "<script>
					jQuery(document).ready(function($) {
						let imageSource = $('#project-image img').attr('src');
						if ( imageSource === '' || imageSource === undefined ) {
							$('#project-image-preview img').attr('src', 'https://snapbuilder.com/code_snippet_generator/image_placeholder_generator/1000x600/007730/DDDDDD/No-image');
						}
						
						/**
						 * Open media uploader on button clicks to select an image.
						 *
						 * @param {function} e The event object.
						 * @returns {void} Returns nothing.
						 * @since 1.0.0
						 */
						$('.projectpress-upload').click(function (e) {
							e.preventDefault();
							
							let image = wp.media({
								title: 'Upload Image',
								multiple: false
							}).open()
								.on('select', function (e) {
									let uploaded_image = image.state().get('selection').first();
									let image_url = uploaded_image.toJSON().url;
									$('#project-image').val(image_url);
								});
						});
						
						/**
						 * Update the link of image preview when user changes the input value.
						 *
						 * @returns {void} Returns nothing.
						 * @since 1.0.0
						 */
						$('#project-image').change(function () {
							let image_url = $(this).val();
							$('#project-image-preview img').attr('src', image_url);
						});
					});
				</script>";
	}

	/**
	 * Method to save the custom fields metabox data.
	 *
	 * @param int $post_id The post ID.
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function save_custom_fields_metabox( int $post_id ): void
	{
		if ( isset( $_POST['project_link'] ) ) {
			update_post_meta( $post_id, 'link', sanitize_text_field( $_POST['project_link'] ) );
		}

		if ( isset( $_POST['project_image'] ) ) {
			update_post_meta( $post_id, 'image', sanitize_text_field( $_POST['project_image'] ) );
		}
	}

	/**
	 * Add taxonomy data to REST API response for custom post type "project"
	 *
	 * @param array $post The post object.
	 * @return array Returns the post object with categories and tags.
	 * @since 1.0.0
	 */
	public function add_rest_taxonomy( array $post ): array
	{
		$post_id = $post['id'];
		$category = wp_get_post_terms( $post_id, 'project_category', array ('fields' => 'names') );
		$tag = wp_get_post_terms( $post_id, 'project_tag', array ('fields' => 'names') );
		$link = get_post_meta( $post_id, 'link', true );
		$image = get_post_meta( $post_id, 'image', true );

		return array (
			'category' => $category,
			'tag' => $tag,
			'link' => $link,
			'image' => $image,
		);
	}

	/**
	 * Add plugin data to REST API response for custom post type "project"
	 *
	 * @return array Returns the plugin data.
	 * @since 1.0.0
	 */
	public function add_rest_generator(): array
	{
		return array (
			'name' => 'ProjectPress',
			'version' => PROJECTPRESS_VERSION,
			'version_code' => PROJECTPRESS_VERSION_CODE,
			'id' => 'projectpress',
		);
	}

	/**
	 * Register the REST API field for categories and tags.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function register_rest_field(): void
	{
		register_rest_field( 'project', 'taxonomy', array (
			'get_callback' => [$this, 'add_rest_taxonomy'],
			'schema' => null,
		) );

		register_rest_field( 'project', 'generator', array (
			'get_callback' => [$this, 'add_rest_generator'],
			'schema' => null,
		) );
	}
}