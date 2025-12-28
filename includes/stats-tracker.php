<?php
if (!defined('ABSPATH'))
    exit;

function cnqr_track_hit($qr_id)
{
    $count = (int) get_post_meta($qr_id, '_cnqr_hits', true);
    update_post_meta($qr_id, '_cnqr_hits', $count + 1);
    update_post_meta($qr_id, '_cnqr_last_scan', current_time('mysql'));
}
