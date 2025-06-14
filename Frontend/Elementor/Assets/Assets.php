<?php
/**
 * Assets.php
 *
 * This file contains the Assets class, which handles the initialization and configuration of the BlogKit Elementor Assets.
 * It ensures the proper loading of required assets such as CSS and JavaScript files for the BlogKit Elementor plugin.
 *
 * @package BlogKit\Frontend\Elementor\Assets
 * @since 1.0.0
 */

namespace BlogKit\Frontend\Elementor\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Handles the initialization and configuration of the BlogKit Elementor Assets.
 * This class ensures the proper loading of required assets such as CSS and JavaScript files.
 *
 * @package BlogKit\Frontend\Elementor\Assets
 * @since 1.0.0
 */
class Assets
{
    /**
     * Constructor for the Assets class.
     *
     * Initializes the assets for the BlogKit Elementor plugin by calling the init() method.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initializes the assets for the BlogKit Elementor plugin.
     *
     * Hooks into WordPress to enqueue necessary scripts and styles.
     *
     * @return void
     */
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    /**
     * Registers JavaScript files for the BlogKit Elementor plugin.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        // General scripts
        wp_register_script('blogkit-main', BLOGKIT_ELEMENTOR_ASSETS . "/js/main.js", ['jquery'], BLOGKIT_VERSION, true);
    }

    /**
     * Enqueues and registers CSS styles for the BlogKit Elementor plugin.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('blogkit-elementor-style', BLOGKIT_ELEMENTOR_ASSETS . "/css/style.css", [], BLOGKIT_VERSION);
        wp_enqueue_style('blogkit-style-2', BLOGKIT_ELEMENTOR_ASSETS . "/css/style2.css", [], BLOGKIT_VERSION);
    }


}
