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

use WP_Query;

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
	 * @return string
	 * @since 1.0.0
	 */
	public function render(): string
	{
		$args = array(
			'post_type'         => 'project',
			'posts_per_page'    => -1,
		);

		$projects_query = new WP_Query( $args );

		$content = '';

		if ( $projects_query->have_posts() ) {
			$content .= '<div class="stechbd-projectpress-grid">';
			while ( $projects_query->have_posts() ) {
				$projects_query->the_post();
				$thumbnail_url = get_the_post_thumbnail_url();
				$project_title = get_the_title();
				$project_excerpt = get_the_excerpt();
				$custom_field_value = get_post_meta( get_the_ID(), 'link', true );
				$permalink = get_permalink();
				$id = get_the_ID();

				$content .= '<a href="#" onclick="event.preventDefault();" data-id="' . $id . ');">';
				$content .= '<div class="item">';
				$content .= '<img src="' . $thumbnail_url . '" alt="' . $project_title . '">';
				$content .= '<h3>' . $project_title . '</h3>';
				$content .= '<p>' . $project_excerpt . '</p>';
				$content .= '<p>' . $custom_field_value . '</p>';
				$content .= '</div>';
				$content .= '</a>';
			}
			$content .= '</div>';
		}

		/*$content .= '<div class="stechbd-projectpress-modal">';
		$content .= '<div class="content">';
		$content .= '<span class="close">&times;</span>';
		$content .= '<div class="details">Loading ...</div>';
		$content .= '</div>';
		$content .= '</div>';*/

		return $content;
	}
}