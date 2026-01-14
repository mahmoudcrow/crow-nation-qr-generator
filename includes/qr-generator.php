<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_generate_qr_image($slug)
{
    // تحميل المكتبة بأمان
    if (!class_exists('QRcode')) {
        $lib_path = CNQR_PATH . 'lib/phpqrcode/qrlib.php';
        if (file_exists($lib_path)) {
            require_once $lib_path;
        } else {
            error_log('CNQR: qrlib.php file not found at ' . $lib_path);
            return false;
        }
    }

    // تأكد من وجود الكلاس
    if (!class_exists('QRcode')) {
        error_log('CNQR: QRcode class not loaded after require_once');
        return false;
    }

    $upload_dir = wp_upload_dir();
    $qr_dir = $upload_dir['basedir'] . '/cnqr';

    // إنشاء المجلد لو مش موجود
    if (!file_exists($qr_dir)) {
        if (!wp_mkdir_p($qr_dir)) {
            return false;
        }
    }

    $file_path = $qr_dir . '/' . $slug . '.png';
    $file_url = $upload_dir['baseurl'] . '/cnqr/' . $slug . '.png';

    // توليد الصورة لو مش موجودة
    if (!file_exists($file_path)) {
        // Check if GD extension is loaded
        if (!extension_loaded('gd')) {
            return false;
        }

        $qr_url = home_url('/go/' . $slug);

        try {
            QRcode::png($qr_url, $file_path, QR_ECLEVEL_H, 8);
        } catch (Exception $e) {
            return false;
        }
    }

    return $file_url;
}
