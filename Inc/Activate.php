<?php 
namespace BlogKit;

/**
 * Don't allow direct access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Plugin activation class
 *
 * Contains methods that are triggered when the plugin is activated.
 */
class Activate {

	/**
	 * Perform actions on plugin activation, like setting default options or creating database tables.
	 *
	 * This function is intended to be run when the plugin is activated.
	 * It ensures that WordPress rewrite rules are flushed to account for any changes
	 * in custom post types or taxonomies that the plugin may introduce.
	 */
	public static function activate() {		
		flush_rewrite_rules();
	}
}