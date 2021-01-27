<?php

/**
 * Plugin Name:       (#plugin_name#)
 * Plugin URI:        (#plugin_url#)
 * Description:       (#plugin_description#)
 * Version:           1.0.0
 * Author:            (#plugin_author#)
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       (#plugin_slug#)
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('(#plugin_cap#)_PATH', plugin_dir_path(__FILE__));
define('(#plugin_cap#)_URL', plugins_url('', __FILE__));
define('(#plugin_cap#)_TEMPLATE_PATH', (#plugin_cap#)_PATH . 'templates/');

load_plugin_textdomain('(#plugin_slug#)', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once (#plugin_cap#)_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once (#plugin_cap#)_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new (#plugin_namespace#)\Vendor\Psr4ClassLoader();
$loader->addPrefix('(#plugin_namespace#)', (#plugin_cap#)_PATH);
$loader->addPrefix('(#plugin_namespace#)', (#plugin_cap#)_PATH . 'source/php/');
$loader->register();

// Start application
new (#plugin_namespace#)\App();
