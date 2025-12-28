<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_export_csv()
{

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=crow-nation-qr-stats.csv');

    $output = fopen('php://output', 'w');

    // CSV Header
    fputcsv($output, [
        'QR Name',
        'QR Slug',
        'Target URL',
        'Scans',
        'Last Scan'
    ]);

    $qrs = get_posts([
        'post_type' => 'cn_qr',
        'posts_per_page' => -1
    ]);

    foreach ($qrs as $qr) {
        $slug = sanitize_title($qr->post_title);
        $target = get_post_meta($qr->ID, '_cnqr_target', true);
        $hits = (int) get_post_meta($qr->ID, '_cnqr_hits', true);
        $last = get_post_meta($qr->ID, '_cnqr_last_scan', true);

        fputcsv($output, [
            $qr->post_title,
            $slug,
            $target,
            $hits,
            $last ? $last : '—'
        ]);
    }

    fclose($output);
    exit;
}
add_action('admin_post_cnqr_export_csv', 'cnqr_export_csv');
