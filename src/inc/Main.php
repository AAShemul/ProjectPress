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
 * Developer: S Technologies Limited
 * Homepage: https://www.stechbd.net
 * Contact: product@stechbd.net
 * Created: June 3, 2023
 * Updated: July 6, 2023
 */


namespace STechBD\ProjectPress;

/**
 * Exit if accessed directly.
 *
 * @since 1.0.0
 */
if(!defined('ABSPATH'))
{
	die('<title>Access Denied | ProjectPress by STechBD.Net</title><h1>ProjectPress by STechBD.Net</h1><p>Access denied for security reasons.</p>');
}

/**
 * The main plugin class.
 *
 * @since 1.0.0
 */
class Main
{
    /**
     * The class constructor method to register activation and deactivation hooks and to load the 'init_plugin' method.
     *
     * It is prevented from being called more than once by using the 'singleton' design pattern.
     *
     * @return void
     * @since 1.0.0
     */
    private function __construct()
    {
        register_activation_hook(ST_PROJECTPRESS_FILE, [$this, 'activate']);
		register_deactivation_hook(ST_PROJECTPRESS_FILE, [$this, 'deactivate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

	/**
	 * Method to initialize the plugin and to load the class constructor method.
	 *
	 * @return Main The class instance.
	 * @since 1.0.0
	 */
    public static function init(): Main
    {
	    $instance = null;

	    if(!$instance)
		{
			$instance = new self();
		}

		return $instance;
    }

    /**
     * Method to run plugin activation activities.
     *
     * @return void
     * @since 1.0.0
     */
    public function activate(): void
    {
        $installed = get_option('stechbd_projectpress_installed');
		$notice = get_option('stechbd_projectpress_notice');
		$noticeValue = 'This website uses cookies to improve your experience. <strong><a href="' . ST_PROJECTPRESS_SITE . 'privacy-policy/">Learn More</a></strong>';

        if(!$installed)
        {
            update_option('stechbd_projectpress_installed', time());
        }

        update_option('stechbd_projectpress_version', ST_PROJECTPRESS_VERSION);
        update_option('stechbd_projectpress_version_code', ST_PROJECTPRESS_VERSION_CODE);

		if(!$notice)
		{
			add_option('stechbd_projectpress_notice', $noticeValue);
		}
    }

	/**
	 * Method to run plugin deactivation activities.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function deactivate(): void
	{
		// To be added later.
	}

    /**
     * Method to initialize the plugin.
     *
     * It loads the Admin\Init class if the user is in the admin panel, otherwise it loads the Frontend\Init class.
     *
     * @return void
     * @since 1.0.0
     */
    public function init_plugin(): void
    {
		if(is_admin())
		{
			new Admin\Init();
		}
		else
		{
			new Frontend\Init();
		}
    }
}