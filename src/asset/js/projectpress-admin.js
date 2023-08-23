/**
 * Project: ProjectPress
 * Description: ProjectPress is a lightweight and beautiful project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Created: August 20, 2023
 * Updated: August 22, 2023
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
	 * Update the link of image preview.
	 *
	 * @returns {void} Returns nothing.
	 * @since 1.0.0
	 */
	function updateImagePreview() {
		const imageValue = $('#project-image').val();
		const imagePreview = $('#project-image-preview img');

		if (imageValue === '' || imageValue === undefined) {
			imagePreview.attr('src', 'https://snapbuilder.com/code_snippet_generator/image_placeholder_generator/1000x600/007730/DDDDDD/No Image. Please upload or select an image from above.');
		} else {
			imagePreview.attr('src', imageValue);
		}
	}

	updateImagePreview();

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

				updateImagePreview();
			});
	});

	/**
	 * Update the link of image preview when user changes the input value.
	 *
	 * @since 1.0.0
	 */
	$('#project-image').on('change keyup', function () {
		updateImagePreview();
	});
})(jQuery);