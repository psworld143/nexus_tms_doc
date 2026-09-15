<?php
// Extract $videoCatalog and $videoDocs from doc_data.php to JSON
require __DIR__ . '/dispatch/doc_data.php';

$output = [
    'videoCatalog' => $videoCatalog,
    'videoDocs' => $videoDocs
];

$json = json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
file_put_contents(__DIR__ . '/react-app/src/data/dispatch-data.json', $json);
echo "Extracted " . count($videoCatalog) . " catalog entries and " . count($videoDocs) . " doc entries\n";
echo "Written to react-app/src/data/dispatch-data.json\n";
