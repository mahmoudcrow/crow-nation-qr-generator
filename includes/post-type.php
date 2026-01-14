<?php
if (!defined('ABSPATH'))
    exit;

/**
 * تسجيل نوع البوست cn_qr
 */
function cnqr_register_qr_post_type()
{
    register_post_type('cn_qr', [
        'labels' => [
            'name' => 'QR Codes',
            'singular_name' => 'QR Code',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'crow-nation-qr',
        'menu_icon' => 'dashicons-qrcode',
        'supports' => ['title'],
    ]);
}
add_action('init', 'cnqr_register_qr_post_type');


/**
 * إضافة الـ Meta Boxes (اللينك + البريفيو)
 */
function cnqr_add_meta_boxes()
{
    // حقل إدخال الرابط
    add_meta_box(
        'cnqr_target',
        'QR Target URL',
        'cnqr_target_callback',
        'cn_qr',
        'normal',
        'high'
    );

    // معاينة كود الـ QR
    add_meta_box(
        'cnqr_preview',
        'QR Code Preview',
        'cnqr_preview_callback',
        'cn_qr',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'cnqr_add_meta_boxes');


/**
 * حقل إدخال اللينك
 */
function cnqr_target_callback($post)
{
    $value = get_post_meta($post->ID, '_cnqr_target', true);

    echo '<input type="url" 
                 name="cnqr_target" 
                 style="width:100%" 
                 value="' . esc_attr($value) . '" 
                 placeholder="https://example.com">';
}


/**
 * حفظ اللينك عند حفظ البوست
 */
function cnqr_save_target_meta($post_id)
{
    // لا تحفظ في الـ autosave أو المراجعات
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['cnqr_target'])) {
        update_post_meta($post_id, '_cnqr_target', esc_url_raw($_POST['cnqr_target']));
    }
}
add_action('save_post_cn_qr', 'cnqr_save_target_meta');


/**
 * معاينة الـ QR داخل صفحة البوست
 */
function cnqr_preview_callback($post)
{
    if (!$post->post_title) {
        echo '<p>اكتب عنوانًا واحفظ الـ QR أولاً.</p>';
        return;
    }

    if (!function_exists('cnqr_generate_qr_image')) {
        echo '<p>QR generator function not found.</p>';
        return;
    }

    $slug = sanitize_title($post->post_title);
    $qr_image = cnqr_generate_qr_image($slug);

    if (!$qr_image) {
        echo '<p>لم يتم توليد QR. تأكد من صلاحيات مجلد uploads أو من وجود مكتبة phpqrcode.</p>';
        return;
    }

    echo '<div style="text-align:center">';
    echo '<img src="' . esc_url($qr_image) . '" style="width:100%;margin-bottom:10px;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.1);" />';
    echo '<p style="font-size:12px;color:#666;"><strong>QR URL:</strong><br>' . esc_html(home_url('/go/' . $slug)) . '</p>';
    echo '</div>';
}