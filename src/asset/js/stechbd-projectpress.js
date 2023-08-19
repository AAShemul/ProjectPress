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
 * Updated: August 19, 2023
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

		$('body').append('' +
			'<div class="stechbd-projectpress-modal">' +
				'<div class="content">' +
					'<span class="close">&times;</span>' +
					'<div class="details">Loading</div>' +
				'</div>' +
			'</div>');

		let projectDetails = $('.stechbd-projectpress-modal .details');
		let html = '' +
			'<div class="thumbnail"><img src="http://aashemul/STechBD/WP-Plugin/wp-content/uploads/2023/08/Thumbnail.png" alt="A" width="100%"></div>' +
			'<div class="title">Name</div>' +
			'<div class="description">Body text</div>';
		projectDetails.html(html);

		/**
		 * Function to load the modal.
		 *
		 * @param {int} id
		 * @returns {void}
		 * @since 1.0.0
		 */
		$('.stechbd-projectpress-modal').on('click', function () {
			console.log('ProjectPress modal is ready.');

			let id = $(this).data('id');
			$('.stechbd-projectpress-modal').fadeIn();
		});

		function loadProjectDetails(projectId) {
			$.ajax({
				type: "POST",
				url: "URL_TO_AJAX_ENDPOINT",
				data: {action: "load_project_details", project_id: projectId},
				success: function (data) {
					projectDetails.html(data);
				},
				error: function (error) {
					console.error("Error loading project details:", error);
				}
			});
		}
	});


})(jQuery);
