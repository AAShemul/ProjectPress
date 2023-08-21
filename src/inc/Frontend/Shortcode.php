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
 * Updated: August 20, 2023
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
		$args = array(
			'post_type' => 'project',
			'posts_per_page' => -1,
		);

		$projects_query = new WP_Query($args);

		$content = '';

		if ($projects_query->have_posts()) {
			$content .= '<div class="stechbd-projectpress-grid">';
			while ($projects_query->have_posts()) {
				$projects_query->the_post();
				$id = get_the_ID();
				$thumbnail = get_the_post_thumbnail_url();
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				$description = get_the_content();
				$link = get_post_meta($id, 'link', true);
				$image = get_post_meta($id, 'image', true);
				$permalink = get_permalink();
				$categories = wp_get_post_terms($id, 'project_category', array('fields' => 'names'));
				$category = !empty($categories) ? implode(', ', $categories) : '';
				$tags = wp_get_post_terms($id, 'project_tag', array('fields' => 'names'));
				$tag = !empty($tags) ? implode(', ', $tags) : '';

				$content .= '<a href="#" class="preview" onclick="event.preventDefault();" data-id="' . $id . '" data-category="' . $category . '">
                            <div class="item">
                                <img src="' . $thumbnail . '" alt="' . $title . '">
                                <p class="category">' . $category . '</p>
                                <h2>' . $title . '</h2>
                                <p>' . $excerpt . '</p>
                            </div>
                        </a>';
			}

			$content .= '</div>';
		}

		// Restore global post data
		wp_reset_postdata();

		return $content;
	}

}