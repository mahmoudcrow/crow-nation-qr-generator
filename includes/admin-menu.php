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
    $args = [
        'post_type' => 'cn_qr',
        'posts_per_page' => -1
    ];

    $qrs = get_posts($args);

    echo '<div class="wrap">';
    echo '<h1>Crow Nation QR Generator – Statistics</h1>';

    if (!$qrs) {
        echo '<p>No QR codes found.</p></div>';
        return;
    }

    echo '<a href="' . admin_url('admin-post.php?action=cnqr_export_csv') . '" class="button button-primary" style="margin-bottom:15px;">Export CSV</a>';

    echo '<table class="widefat fixed striped">';
    echo '<thead>
            <tr>
              <th>QR Name</th>
              <th>Target URL</th>
              <th>Scans</th>
              <th>Last Scan</th>
              <th>QR Link</th>
            </tr>
          </thead><tbody>';

    foreach ($qrs as $qr) {
        $hits = (int) get_post_meta($qr->ID, '_cnqr_hits', true);
        $last = get_post_meta($qr->ID, '_cnqr_last_scan', true);
        $target = get_post_meta($qr->ID, '_cnqr_target', true);
        $slug = sanitize_title($qr->post_title);

        echo '<tr>';
        echo '<td><strong>' . $qr->post_title . '</strong></td>';
        echo '<td><a href="' . $target . '" target="_blank">View</a></td>';
        echo '<td>' . $hits . '</td>';
        echo '<td>' . ($last ? $last : '—') . '</td>';
        echo '<td><a href="' . home_url('/go/' . $slug) . '" target="_blank">Open</a></td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}