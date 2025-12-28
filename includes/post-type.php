<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_register_qr_post_type()
{
    register_post_type('cn_qr', [
        'labels' => [
            'name' => 'QR Codes',
            'singular_name' => 'QR Code'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-qrcode',
        'supports' => ['title'],
    ]);
}
add_action('init', 'cnqr_register_qr_post_type');
