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
        'show_in_menu' => 'crow-nation-qr',
        'menu_icon' => 'dashicons-qrcode',
        'supports' => ['title'],
    ]);
}
add_action('init', 'cnqr_register_qr_post_type');

function cnqr_add_target_meta()
{
    add_meta_box(
        'cnqr_target',
        'QR Target URL',
        'cnqr_target_callback',
        'cn_qr'
    );
}
add_action('add_meta_boxes', 'cnqr_add_target_meta');

function cnqr_target_callback($post)
{
    $value = get_post_meta($post->ID, '_cnqr_target', true);
    echo '<input type="url" name="cnqr_target" style="width:100%" value="' . esc_attr($value) . '" placeholder="https://example.com">';
}

function cnqr_save_target_meta($post_id)
{
    if (isset($_POST['cnqr_target'])) {
        update_post_meta($post_id, '_cnqr_target', esc_url_raw($_POST['cnqr_target']));
    }
}
add_action('save_post', 'cnqr_save_target_meta');

function cnqr_add_qr_preview_meta()
{
    add_action('add_meta_boxes', function () {
        add_meta_box(
            'cnqr_preview',
            'QR Code Preview',
            'cnqr_render_qr_preview',
            'cn_qr',
            'side',
            'high'
        );
    });
    function cnqr_render_qr_preview($post)
    {
        $slug = sanitize_title($post->post_title);

        if (!$slug) {
            echo '<p>Save the QR first to generate the code.</p>';
            return;
        }

        $qr_url = cnqr_generate_qr_image($slug);

        echo '<img src="' . esc_url($qr_url) . '" style="width:100%;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.1);" />';
    }
}
add_action('add_meta_boxes', 'cnqr_add_qr_preview_meta');

function cnqr_preview_callback($post)
{
    if (!$post->post_title) {
        echo '<p>Save the QR code first.</p>';
        return;
    }

    $slug = sanitize_title($post->post_title);
    $qr_image = cnqr_generate_qr_image($slug);

    echo '<img src="' . esc_url($qr_image) . '" style="width:100%;margin-bottom:10px;">';
    echo '<p><strong>QR URL:</strong><br>' . home_url('/go/' . $slug) . '</p>';
}
