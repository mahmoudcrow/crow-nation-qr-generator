<?php
if (!defined('ABSPATH'))
    exit;

require_once CNQR_PATH . 'lib/phpqrcode/qrlib.php';

function cnqr_generate_qr_image($slug)
{

    $upload_dir = wp_upload_dir();
    $qr_dir = $upload_dir['basedir'] . '/cnqr';

    if (!file_exists($qr_dir)) {
        wp_mkdir_p($qr_dir);
    }

    $file_path = $qr_dir . '/' . $slug . '.png';
    $file_url = $upload_dir['baseurl'] . '/cnqr/' . $slug . '.png';

    if (!file_exists($file_path)) {
        $qr_url = home_url('/go/' . $slug);
        QRcode::png($qr_url, $file_path, QR_ECLEVEL_H, 8);
    }

    return $file_url;
}
