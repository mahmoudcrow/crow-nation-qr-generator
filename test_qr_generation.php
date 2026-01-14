<?php
// Test script for QR generation
define('ABSPATH', true);
define('CNQR_PATH', __DIR__ . '/');

// Mock WordPress functions
function wp_upload_dir()
{
    return [
        'basedir' => __DIR__ . '/test_uploads',
        'baseurl' => 'http://example.com/wp-content/uploads'
    ];
}

function wp_mkdir_p($path)
{
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
    return true;
}

function home_url($path = '')
{
    return 'http://example.com' . $path;
}

// Include the QR generator
require_once 'includes/qr-generator.php';

// Test cases
$test_cases = [
    'valid_slug' => 'test-qr',
    'empty_slug' => '',
    'special_chars_slug' => 'test@#$%^&*()',
    'long_slug' => str_repeat('a', 100),
];

echo "Testing QR generation...\n";

foreach ($test_cases as $name => $slug) {
    echo "\nTesting case: $name\n";
    echo "Slug: '$slug'\n";

    $result = cnqr_generate_qr_image($slug);

    if ($result === false) {
        echo "Result: FAILED (returned false)\n";
    } else {
        echo "Result: SUCCESS - $result\n";
        if (file_exists(__DIR__ . '/test_uploads/cnqr/' . $slug . '.png')) {
            echo "File created: YES\n";
        } else {
            echo "File created: NO\n";
        }
    }
}

// Test GD extension check
echo "\nTesting GD extension check...\n";
if (extension_loaded('gd')) {
    echo "GD extension: LOADED\n";
} else {
    echo "GD extension: NOT LOADED\n";
}

// Clean up
$test_dir = __DIR__ . '/test_uploads';
if (file_exists($test_dir)) {
    array_map('unlink', glob("$test_dir/cnqr/*.png"));
    rmdir($test_dir . '/cnqr');
    rmdir($test_dir);
}

echo "\nTest completed.\n";
?>