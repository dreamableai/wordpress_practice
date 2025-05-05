<?php 
namespace BlogKit;

/**
 * Disable direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Deactivate
 *
 * Handles the deactivation of the plugin by performing cleanup tasks
 * such as removing options or clearing caches.
 *
 * @package BlogKit
 */
class Deactivate {

	/**
	 * Perform cleanup on plugin deactivation, like removing options or clearing caches.
	 *
	 * Clears the rewrite rules so that WordPress can generate new ones.
	 */
	public static function deactivate() {       
		// Perform cleanup on plugin deactivation, like removing options or clearing caches.
		flush_rewrite_rules();
	}
}