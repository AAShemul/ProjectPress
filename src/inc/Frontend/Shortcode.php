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
 * The frontend shortcut class file.
 *
 * @since 1.0.0
 */
class Shortcode
{
	/**
	 * The class constructor method to put shortcode in the 'wp_head' hook.
	 *
	 * @return void Returns nothing.
	 * @since 1.0.0
	 */
	public function __construct()
	{
		add_shortcode( 'ProjectPress', [$this, 'render'] );
	}

	/**
	 * Method to load the shortcode view file.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function render(): string
	{
		$args = array (
			'post_type' => 'project',
			'posts_per_page' => -1,
		);

		$projects_query = new WP_Query( $args );

		$content = '<div class="projectpress-filter">';

		$all_categories = get_terms( array (
			'taxonomy' => 'project_category',
			'hide_empty' => true,
		) );

		$content .= __( 'Filter by Categories: ', 'projectpress' ) . '<a href="#" class="option active" onclick="event.preventDefault()" data-category="All">' . __( 'All', 'projectpress' ) . '</a>';

		foreach ( $all_categories as $category ) {
			$content .= '<a href="#" class="option" onclick="event.preventDefault()" data-category="' . $category->slug . '">' . $category->name . '</a>';
		}

		$content .= '</div>';

		$content .= '<div class="projectpress-sort">
				Sort by:
                <a href="#" data-id="default" class="short active" onclick="event.preventDefault()">Default</a> |
                <a href="#" data-id="name-asc" class="short" onclick="event.preventDefault()">Name (Asc)</a> |
                <a href="#" data-id="name-dsc" class="short" onclick="event.preventDefault()">Name (Desc)</a> |
                <a href="#" data-id="category-asc" class="short" onclick="event.preventDefault()">Category (Asc)</a> |
                <a href="#" data-id="category-dsc" class="short" onclick="event.preventDefault()">Category (Desc)</a>
              </div>';

		if ( $projects_query->have_posts() ) {
			$content .= '<div class="projectpress-grid">';
			while ( $projects_query->have_posts() ) {
				$projects_query->the_post();
				$id = get_the_ID();
				$thumbnail = get_the_post_thumbnail_url();
				$title = get_the_title();
				$excerpt = strip_tags( get_the_excerpt() );
				$description = get_the_content();
				$link = get_post_meta( $id, 'link', true );
				$image = get_post_meta( $id, 'image', true );
				$permalink = get_permalink();
				$categories = wp_get_post_terms( $id, 'project_category', array ('fields' => 'names') );
				$category = ! empty( $categories ) ? $categories[0] : '';
				$categories_slugs = wp_get_post_terms( $id, 'project_category', array ('fields' => 'slugs') );
				$category_slug = ! empty( $categories ) ? $categories_slugs[0] : '';
				$tags = wp_get_post_terms( $id, 'project_tag', array ('fields' => 'names') );
				$tag = ! empty( $tags ) ? implode( ', ', $tags ) : '';

				$words = explode( ' ', $excerpt );
				if ( count( $words ) > 20 ) {
					$excerpt = implode( ' ', array_slice( $words, 0, 20 ) ) . ' [...]';
				}

				$content .= '<a href="#" class="preview" onclick="event.preventDefault();" data-id="' . $id . '" data-category="' . $category_slug . '">
                            <div class="item">
                                <img src="' . $thumbnail . '" alt="' . $title . '">
                                <div><span class="category">' . $category . '</span></div>
                                <h3><strong>' . $title . '</strong></h3>
                                <p>' . $excerpt . '</p>
                            </div>
                        </a>';
			}

			$content .= '</div>';
		} else {
			$content .= '<p>' . __( 'No project found.', 'projectpress' ) . '</p>';
		}

		wp_reset_postdata();

		return $content;
	}
}