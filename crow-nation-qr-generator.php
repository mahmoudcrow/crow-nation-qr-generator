<?php
/**
 * Plugin Name: Crow Nation QR Generator
 * Plugin URI: https://github.com/mahmoudcrow/crow-nation-qr-generator
 * Description: Dynamic QR Code Generator with redirect & statistics.
 * Version: 1.0.3
 * Author: Mahmoud Moustafa
 * Author URI: https://github.com/mahmoudcrow
 * Text Domain: crow-nation-qr
 */

if (!defined('ABSPATH'))
    exit;

define('CNQR_PATH', plugin_dir_path(__FILE__));
define('CNQR_URL', plugin_dir_url(__FILE__));

require_once CNQR_PATH . 'includes/qr-generator.php';
require_once CNQR_PATH . 'includes/export-csv.php';
require_once CNQR_PATH . 'includes/github-updater.php';
require_once CNQR_PATH . 'includes/admin-menu.php';
require_once CNQR_PATH . 'includes/post-type.php';
require_once CNQR_PATH . 'includes/redirect-handler.php';
require_once CNQR_PATH . 'includes/stats-tracker.php';

register_activation_hook(__FILE__, function () {
    cnqr_add_rewrite_rule();
    flush_rewrite_rules();
});

register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
});


