/**
 * Project: CookieCons
 * Description: CookieCons is a simple and lightweight cookie consent plugin for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Website: https://www.stechbd.net/project/CookieCons/
 * Developer: S Technologies Limited
 * Homepage: https://www.stechbd.net
 * Contact: product@stechbd.net
 * Created: June 22, 2023
 * Updated: July 5, 2023
 */


/**
 * Use $ code inside this to avoid "$ is not defined" error.
 *
 * @param {function} $
 * @returns {void}
 * @since 1.0.0
 */
;(function($) {
	'use strict';
	
	/**
	 * Function to fire when the document is ready.
	 *
	 * @returns {void}
	 * @since 1.0.0
	 */
	$(document).ready(function() {
		const cookieValue = getCookie('stechbd-cookiecons');

		if (cookieValue === 'accepted') {
			$('.stechbd-cookiecons').hide();
		}

		/**
		 * Function to accept cookies.
		 *
		 * @returns {void}
		 * @since 1.0.0
		 */
		$('.stechbd-cookiecons .close').click(function() {
			setCookie('stechbd-cookiecons', 'accepted');
			$('.stechbd-cookiecons').fadeOut();
		});
	});

	/**
	 * Function to set a cookie.
	 *
	 * @param {string} name
	 * @param {string} value
	 * @returns {void}
	 * @since 1.0.0
	 */
	function setCookie(name, value) {
		const date = new Date();
		date.setTime(date.getTime() + (10 * 365 * 24 * 60 * 60 * 1000)); // Set expiration date to 10 years in the future
		const expires = 'expires=' + date.toUTCString();
		document.cookie = name + '=' + value + ';' + expires + ';path=/';
	}

	/**
	 * Function to retrieve the value of a cookie.
	 *
	 * @param {string} name
	 * @returns {string}
	 * @since 1.0.0
	 */
	function getCookie(name) {
		const cookieName = name + '=';
		const cookieArray = document.cookie.split(';');

		for (let i = 0; i < cookieArray.length; i++) {
			let cookie = cookieArray[i];

			while (cookie.charAt(0) === ' ') {
				cookie = cookie.substring(1);
			}

			if (cookie.indexOf(cookieName) === 0) {
				return cookie.substring(cookieName.length, cookie.length);
			}
		}
	}

})(jQuery);
