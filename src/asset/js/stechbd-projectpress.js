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


/**
 * Use $ code inside this to avoid "$ is not defined" error.
 *
 * @param {function} $
 * @returns {void}
 * @since 1.0.0
 */
;(function ($) {
	'use strict';

	/**
	 * Function to fire when the document is ready.
	 *
	 * @returns {void}
	 * @since 1.0.0
	 */
	$(document).ready(function () {
		console.log('ProjectPress is ready.');

		console.log('This is working.');

		$('.stechbd-projectpress-preview').click(function () {
			console.log('ProjectPress modal is clicked.');

			$('body').append('' +
				'<div class="stechbd-projectpress-modal">' +
					'<div class="content">' +
						'<span class="close">&times;</span>' +
						'<div class="details">Loading ...</div>' +
					'</div>' +
				'</div>');
			$('.stechbd-projectpress-modal').fadeIn();

			let json = $(this).data('info');
			json = JSON.stringify(json);
			let info = JSON.parse(json);
			let projectId = info.id;
			let projectTitle = info.title;
			let projectThumbnail = info.thumbnail;
			let projectDescription = info.description;
			let projectImage = info.image;

			console.log('ID: ' + projectId + ', Title: ' + projectTitle + ', Description: ' + projectDescription + ', Thumbnail: ' + projectThumbnail);

			$('.stechbd-projectpress-modal .details').html(content(projectId, projectTitle, projectThumbnail, projectDescription, projectImage));
		});

		console.log('This is also working.');

		$('body').on('click', '.stechbd-projectpress-modal > .content > .close', function () {
			console.log('Close button is clicked.');
			const modal = $('.stechbd-projectpress-modal');
			modal.fadeOut(function () {
				modal.remove();
			});
		});

		function content(id, title, thumbnail, description, image) {
			return '' +
				'<div class="thumbnail"><img src="' + thumbnail + '" alt="' + title + '" width="100%"></div>' +
				'<div class="title">' + title + '</div>' +
				'<div class="description">' +
					'<div><strong>Description</strong></div>' +
					'<div>' + description + '</div>' +
					'<div><strong>Image</strong></div>' +
					'<div><img src="' + image + '" alt="' + title + '" width="100%"></div>' +
				'</div>';
		}
	});
})(jQuery);
