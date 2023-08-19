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
 * Created: June 21, 2023
 * Updated: July 6, 2023
 */


/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access is denied for security reasons.</p>' );
}


/**
 * The frontend notice view file.
 *
 * @since 1.0.0
 */


?>
<div class="stechbd-projectpress">
	<div class="notice">
		<?= get_option( 'stechbd_projectpress_notice' ) ?>
	</div>
	<div class="close">
		Got it
	</div>
</div>