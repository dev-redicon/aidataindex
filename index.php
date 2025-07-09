<?php
header('Content-Type: application/json');

$jsonFile = __DIR__ . '/index.json';

if (file_exists($jsonFile)) {
    $jsonContent = file_get_contents($jsonFile);
    echo $jsonContent;
} else {
    http_response_code(404);
    echo json_encode(['error' => 'JSON file not found.']);
}
?>
