<?php


/**
 * Project: ProjectPress
 * Description: ProjectPress is a lightweight and beautiful project showcase generator for WordPress.
 * Version: 1.0.0
 * Version Code: 1
 * Since: 1.0.0
 * Author: Md. Ashraful Alam Shemul
 * Email: ceo@stechbd.net
 * Created: August 17, 2023
 * Updated: August 17, 2023
 */


/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress</title><h1>ProjectPress</h1><p>Access is denied for security reasons.</p>' );
}

/**
 * Settings view file.
 *
 * @since 1.0.0
 */


?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Settings - ProjectPress', 'projectpress' ) ?></h1>
	<hr class="wp-header-end">
	<?php settings_errors( 'projectpress' ) ?>
	<div id="ajax-response"></div>
	<p><?php _e( 'Choose whether all your created projects to be kept or deleted on the deactivation of ProjectPress.', 'projectpress' ) ?></p>
	<form method="post" name="settings" id="settings" class="validate">
		<table class="form-table" role="presentation">
			<tbody>
			<tr class="form-field form-required">
				<th scope="row">
					<?php _e( 'Delete all projects on plugin deactivation', 'projectpress' ) ?> <span
							class="description">(<?php _e( 'Optional', 'projectpress' ) ?>)</span>
				</th>
				<td>
					<label>
						<select name="delete_projects" id="delete_projects">
							<option value="true" <?php selected( get_option( 'stechbd_projectpress_delete_projects' ), 'true' ) ?>><?php _e( 'Yes', 'projectpress' ) ?></option>
							<option value="false" <?php selected( get_option( 'stechbd_projectpress_delete_projects' ), 'false' ) ?>><?php _e( 'No', 'projectpress' ) ?></option>
						</select>
				</td>
			</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'projectpress' ) ?>
		<?php submit_button( __( 'Save', 'projectpress' ), 'button-primary', 'submitProjectPress' ) ?>
	</form>
</div>