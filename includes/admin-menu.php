<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_admin_menu()
{
    add_menu_page(
        'Crow Nation QR',
        'Crow Nation QR',
        'manage_options',
        'crow-nation-qr',
        'cnqr_dashboard',
        'dashicons-qrcode',
        26
    );
}
add_action('admin_menu', 'cnqr_admin_menu');

function cnqr_dashboard()
{
    echo '<div class="wrap"><h1>Crow Nation QR Generator</h1><p>Manage your QR codes & statistics.</p></div>';
}
