<?php


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
 * Created: June 17, 2023
 * Updated: July 6, 2023
 */


/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if(!defined('ABSPATH'))
{
	die('<title>Access Denied | CookieCons by STechBD.Net</title><h1>CookieCons by STechBD.Net</h1><p>Access denied for security reasons.</p>');
}

/**
 * Settings view file.
 *
 * @since 1.0.0
 */


?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e('Settings - CookieCons', 'stechbd-cookiecons') ?></h1>
	<hr class="wp-header-end">
	<?php settings_errors('stechbd-cookiecons') ?>
	<div id="ajax-response"></div>
	<p><?php _e('Put your custom notice for cookie policy.', 'stechbd-cookiecons') ?></p>
	<form method="post" name="notice" id="notice" class="validate">
		<table class="form-table" role="presentation">
			<tbody>
			<tr class="form-field form-required">
				<th scope="row">
					<?php _e('Custom Notice', 'stechbd-cookiecons') ?> <span class="description">(<?php _e('optional', 'stechbd-cookiecons') ?>)</span>
				</th>
				<td>
					<label>
						<textarea placeholder="This website uses cookies to improve your experience. &lt;strong&gt;&lt;a href=&quot;<?= ST_COOKIECONS_SITE ?>privacy-policy/&quot;&gt;Learn More&lt;/a&gt;&lt;/strong&gt;" rows="4" cols="70" id="notice" name="notice"><?= get_option('stechbd_cookiecons_notice') ?></textarea>
					</label>
				</td>
			</tr>
			</tbody>
		</table>
		<?php wp_nonce_field('stechbd-cookiecons') ?>
		<?php submit_button(__('Save', 'stechbd-cookiecons'), 'button-primary', 'submitNotice') ?>
	</form>
</div>