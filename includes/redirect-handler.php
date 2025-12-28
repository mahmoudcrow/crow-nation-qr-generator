<?php
if (!defined('ABSPATH'))
    exit;

/**
 * Add rewrite rule
 */
function cnqr_add_rewrite_rule()
{
    add_rewrite_rule(
        '^go/([^/]*)/?',
        'index.php?cnqr=$matches[1]',
        'top'
    );
}
add_action('init', 'cnqr_add_rewrite_rule');

/**
 * Register query var
 */
function cnqr_register_query_var($vars)
{
    $vars[] = 'cnqr';
    return $vars;
}
add_filter('query_vars', 'cnqr_register_query_var');

/**
 * Handle redirect
 */
function cnqr_handle_redirect()
{
    $slug = get_query_var('cnqr');
    if (!$slug)
        return;

    $qr = get_page_by_title($slug, OBJECT, 'cn_qr');
    if (!$qr)
        return;

    $url = get_post_meta($qr->ID, '_cnqr_target', true);
    if (!$url)
        return;

    cnqr_track_hit($qr->ID);

    wp_redirect(esc_url_raw($url), 302);
    exit;
}
add_action('template_redirect', 'cnqr_handle_redirect');
