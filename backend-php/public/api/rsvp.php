<?php

declare(strict_types=1);

require_once __DIR__ . '/../../src/bootstrap.php';

allow_cors();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    $pdo = db();

    if ($method === 'GET') {
        $statement = $pdo->query(
            'SELECT id, name, attendance, guests, submitted_at AS submittedAt FROM rsvp_responses WHERE DATE(submitted_at) >= CURDATE() ORDER BY submitted_at DESC, id DESC'
        );

        json_response(['data' => $statement->fetchAll()]);
    }

    if ($method === 'POST') {
        $payload = request_json();
        $name = trim((string) ($payload['name'] ?? ''));
        $attendance = (string) ($payload['attendance'] ?? 'yes');
        $guests = $attendance === 'yes' ? max(1, (int) ($payload['guests'] ?? 1)) : 0;

        if ($name === '') {
            validation_error('Nama wajib diisi.');
        }

        if (!in_array($attendance, ['yes', 'no'], true)) {
            validation_error('Status kehadiran tidak valid.');
        }

        $statement = $pdo->prepare(
            'INSERT INTO rsvp_responses (name, attendance, guests) VALUES (:name, :attendance, :guests)'
        );
        $statement->execute([
            ':name' => $name,
            ':attendance' => $attendance,
            ':guests' => $guests,
        ]);

        $id = (int) $pdo->lastInsertId();
        $fetchStatement = $pdo->prepare(
            'SELECT id, name, attendance, guests, submitted_at AS submittedAt FROM rsvp_responses WHERE id = :id LIMIT 1'
        );
        $fetchStatement->execute([':id' => $id]);

        json_response([
            'message' => 'RSVP tersimpan.',
            'data' => $fetchStatement->fetch(),
        ], 201);
    }

    method_not_allowed();
} catch (PDOException $exception) {
    json_response([
        'message' => 'Gagal mengakses database RSVP.',
        'error' => env_value('APP_ENV') === 'local' ? $exception->getMessage() : null,
    ], 500);
}
