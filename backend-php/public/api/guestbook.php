<?php

declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php';

allow_cors();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    $pdo = db();

    if ($method === 'GET') {
        $statement = $pdo->query(
            'SELECT id, name, message, created_at AS createdAt FROM guestbook_wishes WHERE DATE(created_at) >= CURDATE() ORDER BY created_at DESC, id DESC'
        );

        json_response(['data' => $statement->fetchAll()]);
    }

    if ($method === 'POST') {
        $payload = request_json();
        $name = trim((string) ($payload['name'] ?? ''));
        $message = trim((string) ($payload['message'] ?? ''));

        if ($name === '') {
            validation_error('Nama wajib diisi.');
        }

        if ($message === '') {
            validation_error('Ucapan wajib diisi.');
        }

        $statement = $pdo->prepare(
            'INSERT INTO guestbook_wishes (name, message) VALUES (:name, :message)'
        );
        $statement->execute([
            ':name' => $name,
            ':message' => $message,
        ]);

        $id = (int) $pdo->lastInsertId();
        $fetchStatement = $pdo->prepare(
            'SELECT id, name, message, created_at AS createdAt FROM guestbook_wishes WHERE id = :id LIMIT 1'
        );
        $fetchStatement->execute([':id' => $id]);

        json_response([
            'message' => 'Ucapan tersimpan.',
            'data' => $fetchStatement->fetch(),
        ], 201);
    }

    method_not_allowed();
} catch (PDOException $exception) {
    json_response([
        'message' => 'Gagal mengakses database buku tamu.',
        'error' => env_value('APP_ENV') === 'local' ? $exception->getMessage() : null,
    ], 500);
}