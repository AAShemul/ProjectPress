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
 * Created: August 20, 2023
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
	$('.stechbd-projectpress-upload').click(function (e) {
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
})(jQuery);