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
		const item = $('.projectpress-grid a .item');
		const itemWidth = item.width();

		/**
		 * Function to filter the projects.
		 *
		 * @returns {void} Returns nothing.
		 * @since 1.0.0
		 */
		$('.projectpress-filter .option').click(function () {
			const category = $(this).data('category');

			if (!$(this).hasClass('active')) {
				$('.projectpress-filter .option').removeClass('active');
				$(this).addClass('active');
			}

			if (category === 'All') {
				$('.projectpress-grid a').show();
			} else {
				$('.projectpress-grid a').hide();
				item.each(function () {
					$(this).width(itemWidth);
				});
				$('.projectpress-grid a[data-category="' + category + '"]').show();
			}
		});

		/**
		 * Function to sort projects.
		 *
		 * @returns {void} Returns nothing.
		 * @since 1.0.0
		 */
		$('.projectpress-sort .short').click(function () {
			const sortId = $(this).data('id');
			const projects = $('.projectpress-grid a');

			$('.projectpress-sort .short').removeClass('active');
			$(this).addClass('active');

			if (sortId === 'name-asc') {
				projects.sort(function (a, b) {
					const titleA = $(a).find('h3 strong').text().toUpperCase();
					const titleB = $(b).find('h3 strong').text().toUpperCase();
					return titleA.localeCompare(titleB);
				});
				$('.projectpress-grid').html(projects);
			} else if (sortId === 'name-dsc') {
				projects.sort(function (a, b) {
					const titleA = $(a).find('h3 strong').text().toUpperCase();
					const titleB = $(b).find('h3 strong').text().toUpperCase();
					return titleB.localeCompare(titleA);
				});
				$('.projectpress-grid').html(projects);
			} else if (sortId === 'category-asc') {
				projects.sort(function (a, b) {
					const categoryA = $(a).data('category').toUpperCase();
					const categoryB = $(b).data('category').toUpperCase();
					return categoryA.localeCompare(categoryB);
				});
				$('.projectpress-grid').html(projects);
			} else if (sortId === 'category-dsc') {
				projects.sort(function (a, b) {
					const categoryA = $(a).data('category').toUpperCase();
					const categoryB = $(b).data('category').toUpperCase();
					return categoryB.localeCompare(categoryA);
				});
				$('.projectpress-grid').html(projects);
			}
		});

		/**
		 * Function to open the modal.
		 *
		 * @returns {void} Returns nothing.
		 * @since 1.0.0
		 */
		$('.projectpress-grid a').click(function () {
			$('body').append('' +
				'<div class="projectpress-modal">' +
				'<div class="content">' +
				'<div class="close"><span>&times;</span></div>' +
				'<div class="loading"><div class="spinner"></div></div>' +
				'</div>' +
				'</div>');
			$('.projectpress-modal').fadeIn();

			let id = $(this).data('id');

			load(id).then(info => {
				let projectTitle = info.title.rendered;
				let projectDescription = info.content.rendered;
				let projectLink = info.taxonomy.link;
				let projectImage = info.taxonomy.image;
				let projectCategory = info.taxonomy.category;
				let projectTag = info.taxonomy.tag;
				projectCategory = projectCategory.join(', ');
				projectTag = projectTag.join(', ');

				media(info.featured_media).then(mediaInfo => {
					let projectThumbnail = '';
					if (mediaInfo) {
						projectThumbnail = mediaInfo.media_details.sizes.full.source_url;
					}

					$('.projectpress-modal .content .loading').remove();
					$('.projectpress-modal .content').append(content(projectTitle, projectThumbnail, projectDescription, projectLink, projectImage, projectCategory, projectTag));
				}).catch(error => {
					console.log('Error fetching media: ' + JSON.stringify(error));
				});
			}).catch(error => {
				console.log('Error fetching project data: ' + JSON.stringify(error));
			});
		});

		/**
		 * Function to close the modal.
		 *
		 * @returns {void} Returns nothing.
		 * @since 1.0.0
		 */
		$('body').on('click', '.projectpress-modal > .content > .close', function () {
			const modal = $('.projectpress-modal');
			modal.fadeOut(function () {
				modal.remove();
			});
		});

		/**
		 * Function to generate modal content.
		 *
		 * @param {string} title Title of the project.
		 * @param {string} thumbnail Thumbnail of the project.
		 * @param {string} description Description of the project.
		 * @param {string} link Link of the project.
		 * @param {string} image Image of the project.
		 * @param {string} category Category of the project.
		 * @param {string} tag Tag of the project.
		 * @returns {string} Returns modal content.
		 */
		function content(title, thumbnail, description, link, image, category, tag) {
			return '' +
				'<div class="details">' +
				'<div class="thumbnail"><img src="' + thumbnail + '" alt="' + title + '" width="100%"></div>' +
				'<div class="head">' +
				'<h3><strong>' + title + '</strong></h3>' +
				'<p><strong>Category:</strong> ' + category + '</p>' +
				'<a href="' + link + '" target="_blank" rel="nofollow">' +
				'<div class="button">View Project</div>' +
				'</a>' +
				'</div>' +
				'<div class="description">' +
				'<h3><strong>Description</strong></h3>' +
				'<p>Tag(s): ' + tag + '</p>' +
				'<p>' + description + '</p>' +
				'<h3><strong>Preview Image</strong></h3>' +
				'<div><img src="' + image + '" alt="' + title + '" width="100%"></div>' +
				'</div>' +
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
						url: ProjectPress.restProjectURL + id + '/',
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
						url: ProjectPress.restMediaURL + id + '/',
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