<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'name' => 'Wedding PHP API',
    'status' => 'ok',
    'endpoints' => [
        '/api/rsvp.php',
        '/api/guestbook.php',
    ],
], JSON_UNESCAPED_SLASHES);