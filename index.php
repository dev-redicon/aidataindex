<?php
header('Content-Type: application/json; charset=utf-8');

$jsonFile = __DIR__ . '/index.json';

if (is_readable($jsonFile)) {
    readfile($jsonFile);
    exit;
}

http_response_code(404);
echo json_encode([
    'aiDataIndexVersion' => '1.1',
    'format' => 'ai-json',
    'type' => 'Error',
    'error' => 'JSON file not found.'
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
