<?php
/**
 * Manager.php
 *
 * This file contains the Manager class, which is responsible for initializing
 * the required configurations and functionalities for the BlogKit plugin.
 * It handles both admin and frontend initializations and ensures everything is set up properly.
 *
 * @package BlogKit\Inc
 * @since 1.0.0
 */

namespace BlogKit;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use BlogKit\Admin\AdminManager;
use BlogKit\Frontend\Frontend;

/**
 * The Manager class for BlogKit.
 *
 * This class handles the initialization of BlogKit functionalities,
 * including admin and frontend setup.
 *
 * @package BlogKit\Inc
 * @since 1.0.0
 */
class Manager
{
    /**
     * Admin manager instance.
     *
     * @var AdminManager
     */
    protected $admin_manager;

    /**
     * Frontend manager instance.
     *
     * @var Frontend
     */
    protected $frontend;

    /**
     * Constructor for the Manager class.
     *
     * Initializes the BlogKit Manager by calling the init method.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize the BlogKit Manager.
     *
     * Sets up admin and frontend components.
     *
     * @since 1.0.0
     */
    public function init()
    {
       // $this->admin_manager = new AdminManager();
        $this->frontend = new Frontend();
    }
}
