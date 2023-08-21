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
 * Updated: August 21, 2023
 */


/**
 * Use $ code inside this to avoid "$ is not defined" error.
 *
 * @param {function} $
 * @returns {void} Returns nothing.
 * @since 1.0.0
 */
;(function ($) {
	'use strict';

	/**
	 * Function to fire when the document is ready.
	 *
	 * @returns {void} Returns nothing.
	 * @since 1.0.0
	 */
	$(document).ready(function () {
		console.log('ProjectPress is ready.');
		console.log('Nonce: ' + stechbdProjectPress.nonce);

		$('.stechbd-projectpress-grid a').click(function () {
			console.log('ProjectPress modal is clicked.');

			$('body').append('' +
				'<div class="stechbd-projectpress-modal">' +
				'<div class="content">' +
				'<span class="close">&times;</span>' +
				'<div class="details">Loading ...</div>' +
				'</div>' +
				'</div>');
			$('.stechbd-projectpress-modal').fadeIn();

			let id = $(this).data('id');

			load(id).then(info => {
				console.log('Info: ', info);
				if (info) {
					// Process the retrieved info here
					let projectTitle = info.title.rendered;
					let projectDescription = info.content.rendered;
					let projectLink = info.taxonomy.link;
					let projectImage = info.taxonomy.image;
					let projectCategory = info.taxonomy.category;
					let projectTag = info.taxonomy.tag;
					projectCategory = projectCategory.join(', ');
					projectTag = projectTag.join(', ');

					// You can call the media function within this block as well
					media(info.featured_media).then(mediaInfo => {
						let projectThumbnail = '';
						if (mediaInfo) {
							projectThumbnail = mediaInfo.media_details.sizes.full.source_url;
						}

						// Now that you have both project info and media info, you can update your modal content
						$('.stechbd-projectpress-modal .details').html(content(projectTitle, projectThumbnail, projectDescription, projectLink, projectImage, projectCategory, projectTag));
					}).catch(error => {
						console.log('Error fetching media: ', error);
					});
				}
			}).catch(error => {
				console.log('Error fetching project info: ', error);
			});
		});

		console.log('This is also working.');

		$('body').on('click', '.stechbd-projectpress-modal > .content > .close', function () {
			console.log('Close button is clicked.');
			const modal = $('.stechbd-projectpress-modal');
			modal.fadeOut(function () {
				modal.remove();
			});
		});

		function content(title, thumbnail, description, link, image, category, tag) {
			return '' +
				'<div class="thumbnail"><img src="' + thumbnail + '" alt="' + title + '" width="100%"></div>' +
				'<div class="head">' +
				'<h2><strong>' + title + '</strong></h2>' +
				'<p><strong>[ ' + category + ' ]</strong></p>' +
				'<a href="' + link + '" target="_blank" rel="nofollow">' +
				'<div class="button">View Project</div>' +
				'</a>' +
				'</div>' +
				'<div class="description">' +
				'<h3><strong>Description</strong></h3>' +
				'<p>Tag(s): ' + tag + '</p>' +
				'<p>' + description + '</p>' +
				'<h3><strong>Image</strong></h3>' +
				'<div><img src="' + image + '" alt="' + title + '" width="100%"></div>' +
				'</div>';
		}

		/**
		 * Function to load project details using AJAX.
		 *
		 * @param {int} id ID of the project.
		 * @returns {Promise} Promise that resolves with project details.
		 */
		function load(id = null) {
			if (id !== null) {
				return new Promise((resolve, reject) => {
					$.ajax({
						url: stechbdProjectPress.restProjectURL + id + '/',
						type: 'GET',
						success: (response) => {
							resolve(response);
						},
						error: (error) => {
							reject(error);
						},
					});
				});
			} else {
				return Promise.resolve(null);
			}
		}

		/**
		 * Function to load media using AJAX.
		 *
		 * @param {int} id ID of the media.
		 * @returns {Promise} Promise that resolves with media details.
		 */
		function media(id = null) {
			if (id !== null) {
				return new Promise((resolve, reject) => {
					$.ajax({
						url: stechbdProjectPress.restMediaURL + id + '/',
						type: 'GET',
						success: (response) => {
							resolve(response);
						},
						error: (error) => {
							reject(error);
						},
					});
				});
			} else {
				return Promise.resolve(null);
			}
		}
	});
})(jQuery);