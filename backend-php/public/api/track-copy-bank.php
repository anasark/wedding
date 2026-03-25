<?php
require_once __DIR__ . '/../../src/bootstrap.php';

allow_cors();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method !== 'POST') {
    method_not_allowed();
}

$payload = request_json();
$bankName = trim((string)($payload['bank_name'] ?? ''));
$accountNumber = trim((string)($payload['account_number'] ?? ''));

if ($bankName === '' || $accountNumber === '') {
    json_response(['status' => 'error', 'message' => 'Missing required fields.'], 400);
}

$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

try {
    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO bank_copy_logs (ip_address, bank_name, account_number, user_agent) VALUES (:ip, :bank, :account, :ua)');
    $stmt->execute([
        ':ip' => $ipAddress,
        ':bank' => $bankName,
        ':account' => $accountNumber,
        ':ua' => $userAgent,
    ]);
    json_response(['status' => 'tracked']);
} catch (PDOException $e) {
    json_response(['status' => 'error'], 500);
}
