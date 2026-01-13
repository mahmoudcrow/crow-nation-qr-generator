<?php
if (!defined('ABSPATH'))
    exit;

require_once CNQR_PATH . 'vendor/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/mahmoudcrow/crow-nation-qr-generator',
    CNQR_PATH . 'crow-nation-qr-generator.php',
    'crow-nation-qr-generator'
);

// الفرع الرئيسي
$updateChecker->setBranch('main');
