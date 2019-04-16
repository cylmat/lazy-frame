<?php
/**
 * PHPUnit Maginfo bootstrap unittest files
 *
 * @package Mag_Info
 */

use Brain\Monkey;

/**
 * The following snippets uses `PLUGIN` to prefix
 * the constants and class names. You should replace
 * it with something that matches your plugin name.
 */
// define test environment
define( 'PLUGIN_PHPUNIT', true );

// define fake ABSPATH
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__.'/../../../../' );
}
// define fake PLUGIN_ABSPATH
if ( ! defined( 'PLUGIN_ABSPATH' ) ) {
	define( 'PLUGIN_ABSPATH', ABSPATH . 'wp-content/plugins/mag-info/' );
}

require __DIR__.'/../functions.php';
/*
 * 
 * Autoload
 *
 * @param string $class_name Name of called class.
 * 
function maginfo_autoload( $class_name ) {
	$path      = __DIR__ . '/src/';
	$class_sub = 'class-' . strtolower( $class_name );

	$admin = $path . 'admin/' . $class_sub . '.php';
	$views = $path . 'views/' . $class_sub . '.php';

	if ( file_exists( $admin ) ) {

		require_once $admin;
	}
	if ( file_exists( $views ) ) {
		require_once $views;
	}
}
 */

Monkey\setUp();

require ABSPATH . 'wp-content/mu-plugins/init_wp_env.php';
require ABSPATH . 'wp-content/mu-plugins/StdLog.php';
require ABSPATH . 'wp-content/mu-plugins/log.php';

spl_autoload_register( 'maginfo_autoload' );

//require_once ABSPATH . 'vendor/autoload.php';
