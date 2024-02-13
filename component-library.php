<?php

/**
 * Plugin Name:       component-library
 * Plugin URI:        (#plugin_url#)
 * Description:       A library of blade components
 * Version: 3.15.0
 * Author:            Eric Rosenborg
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       component-library
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    //die;
}

if(function_exists('plugin_dir_path') && function_exists('plugin_url')) {
    define('COMPONENTLIBRARY_PATH', plugin_dir_path(__FILE__));
    define('COMPONENTLIBRARY_URL', plugins_url('', __FILE__));
} else {
    define('COMPONENTLIBRARY_PATH', dirname(__FILE__) . '/');
}

define('COMPONENTLIBRARY_TEMPLATE_PATH', COMPONENTLIBRARY_PATH . 'templates/');

if(function_exists('plugin_basename')) {
    load_plugin_textdomain('component-library', false, plugin_basename(dirname(__FILE__)) . '/languages');
}

require_once COMPONENTLIBRARY_PATH . 'Public.php';