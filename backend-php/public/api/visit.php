<?php

declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php';

allow_cors();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    method_not_allowed();
}

// 1. Dapatkan IP Address (tergantung pakai Cloudflare, Proxy, atau Direct)
$ipAddress = $_SERVER['HTTP_CF_CONNECTING_IP'] 
    ?? $_SERVER['HTTP_X_FORWARDED_FOR'] 
    ?? $_SERVER['REMOTE_ADDR'] 
    ?? 'UNKNOWN';

if (strpos($ipAddress, ',') !== false) {
    $ipAddress = trim(explode(',', $ipAddress)[0]);
}

$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

// 2. Deteksi OS
$os = 'Unknown';
if (preg_match('/windows|win32/i', $userAgent)) $os = 'Windows';
elseif (preg_match('/macintosh|mac os x/i', $userAgent)) $os = 'macOS';
elseif (preg_match('/linux/i', $userAgent)) $os = 'Linux';
elseif (preg_match('/android/i', $userAgent)) $os = 'Android';
elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) $os = 'iOS';

// 3. Deteksi Tipe Device
$device = 'Desktop';
if (preg_match('/mobile|android|touch|webos|hpwos/i', strtolower($userAgent))) {
    $device = 'Mobile';
}
if (preg_match('/ipad|tablet|kindle/i', strtolower($userAgent)) || ($os === 'iOS' && strpos(strtolower($userAgent), 'iphone') === false)) {
    $device = 'Tablet';
}

// 4. Deteksi Browser
$browser = 'Unknown';
if (preg_match('/edg/i', $userAgent)) $browser = 'Edge';
elseif (preg_match('/opr\//i', $userAgent)) $browser = 'Opera';
elseif (preg_match('/chrome|chromium|crios/i', $userAgent)) $browser = 'Chrome';
elseif (preg_match('/firefox|fxios/i', $userAgent)) $browser = 'Firefox';
elseif (preg_match('/safari/i', $userAgent)) $browser = 'Safari';

try {
    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO visitor_logs (ip_address, user_agent, os, device, browser) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$ipAddress, $userAgent, $os, $device, $browser]);
    
    json_response(['status' => 'tracked'], 201);
} catch (PDOException $e) {
    // Kalau database nolak atau tabel belum ada, kita diemin aja supaya frontend tidak rusak.
    json_response(['status' => 'error', 'message' => 'Tracking ignored'], 500);
}
