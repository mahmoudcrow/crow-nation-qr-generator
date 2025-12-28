<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_handle_redirect()
{
    if (!isset($_GET['cnqr']))
        return;

    $slug = sanitize_text_field($_GET['cnqr']);
    $qr = get_page_by_title($slug, OBJECT, 'cn_qr');

    if ($qr) {
        $url = get_post_meta($qr->ID, '_cnqr_target', true);
        cnqr_track_hit($qr->ID);
        wp_redirect($url);
        exit;
    }
}
add_action('init', 'cnqr_handle_redirect');
