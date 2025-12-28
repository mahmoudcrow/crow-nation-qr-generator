<?php
/**
 * Plugin Name: Crow Nation QR Generator
 * Plugin URI: https://github.com/mahmudmoustafa/crow-nation-qr-generator
 * Description: Dynamic QR Code Generator with redirect & statistics.
 * Version: 1.0.0
 * Author: Mahmud Moustafa
 * Author URI: https://github.com/mahmudmoustafa
 * Text Domain: crow-nation-qr
 */

if (!defined('ABSPATH'))
    exit;

define('CNQR_PATH', plugin_dir_path(__FILE__));
define('CNQR_URL', plugin_dir_url(__FILE__));

require_once CNQR_PATH . 'includes/admin-menu.php';
require_once CNQR_PATH . 'includes/post-type.php';
require_once CNQR_PATH . 'includes/redirect-handler.php';
require_once CNQR_PATH . 'includes/stats-tracker.php';
