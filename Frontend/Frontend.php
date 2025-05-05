<?php
/**
 * Frontend.php
 *
 * This file contains the Frontend class, which is responsible for handling
 * the initialization and configuration of the BlogKit frontend.
 * It sets up necessary hooks, scripts, and frontend-specific functionalities.
 *
 * @package BlogKit\Frontend
 * @since 1.0.0
 */

namespace BlogKit\Frontend;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use BlogKit\Frontend\Elementor\Configuration;

/**
 * Class Frontend
 *
 * Handles the initialization and configuration of the BlogKit frontend.
 * This includes registering scripts, styles, and any other public-facing functionalities.
 *
 * @package BlogKit\Frontend
 * @since 1.0.0
 */
class Frontend
{
    /**
     * Elementor configuration instance (optional).
     *
     * @var Configuration|null
     */
    protected $elementor_config;

    /**
     * Frontend constructor.
     *
     * Initializes the BlogKit frontend.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initialize the BlogKit frontend.
     *
     * Set up scripts, styles, and optionally Elementor configurations.
     *
     * @since 1.0.0
     */
    public function initialize()
    {
        // Initialize Elementor configuration if the class exists.
        if (class_exists('BlogKit\Frontend\Elementor\Configuration')) {
            $this->elementor_config = Configuration::instance();
        }
       
    }

}