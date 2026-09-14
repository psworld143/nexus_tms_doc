<?php
// api/feedback.php — Documentation feedback API for DISPATCH
// Stores feedback in data/feedback.json (no database required).

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

define('FEEDBACK_FILE', __DIR__ . '/../data/feedback.json');
define('MAX_FEEDBACK', 1000);
define('MAX_MSG_LEN', 2000);
define('MIN_MSG_LEN', 2);
define('MAX_NAME_LEN', 50);
define('MAX_DOC_LEN', 100);
define('MAX_TITLE_LEN', 200);

function loadFeedback(): array {
    if (!file_exists(FEEDBACK_FILE)) return [];
    $raw = @file_get_contents(FEEDBACK_FILE);
    if ($raw === false) return [];
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function saveFeedback(array $feedback): bool {
    $dir = dirname(FEEDBACK_FILE);
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $trimmed = array_slice($feedback, 0, MAX_FEEDBACK);
    $tmp = FEEDBACK_FILE . '.tmp';
    $json = json_encode($trimmed, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (@file_put_contents($tmp, $json) === false) return false;
    return @rename($tmp, FEEDBACK_FILE);
}

function clean(string $s, int $max): string {
    $s = trim($s);
    $s = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $s);
    if (mb_strlen($s) > $max) $s = mb_substr($s, 0, $max);
    return $s;
}

function genId(): string {
    return bin2hex(random_bytes(8)) . dechex(time());
}

function getClientIP(): string {
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function isValidName(string $name): bool {
    if ($name === '') return true;
    if (preg_match('/<[^>]+>/', $name)) return false;
    if (preg_match('#https?://#i', $name)) return false;
    if (preg_match('/\bwww\./i', $name)) return false;
    return true;
}

function isValidMessage(string $msg): bool {
    return mb_strlen(trim($msg)) >= MIN_MSG_LEN;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $all = loadFeedback();
    // Optional filters
    $docId = $_GET['doc_id'] ?? '';
    $vote = $_GET['vote'] ?? '';
    if ($docId !== '') {
        $all = array_values(array_filter($all, function($f) use ($docId) {
            return ($f['doc_id'] ?? '') === $docId;
        }));
    }
    if ($vote !== '' && in_array($vote, ['up', 'down'], true)) {
        $all = array_values(array_filter($all, function($f) use ($vote) {
            return ($f['vote'] ?? '') === $vote;
        }));
    }
    // Sort newest first
    usort($all, function($a, $b) {
        return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
    });
    echo json_encode(['ok' => true, 'feedback' => $all, 'count' => count($all)], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input)) $input = $_POST;

    $vote = ($input['vote'] ?? '');
    if (!in_array($vote, ['up', 'down'], true)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Invalid vote.']);
        exit;
    }

    $docId = clean($input['doc_id'] ?? '', MAX_DOC_LEN);
    $docTitle = clean($input['doc_title'] ?? '', MAX_TITLE_LEN);
    $name = clean($input['name'] ?? 'Anonymous', MAX_NAME_LEN);
    if ($name === '') $name = 'Anonymous';
    if (!isValidName($name)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Invalid name.']);
        exit;
    }

    $message = clean($input['message'] ?? '', MAX_MSG_LEN);

    $entry = [
        'id' => genId(),
        'doc_id' => $docId,
        'doc_title' => $docTitle,
        'vote' => $vote,
        'name' => $name,
        'message' => $message,
        'ip' => getClientIP(),
        'timestamp' => time()
    ];

    $feedback = loadFeedback();
    $feedback[] = $entry;
    if (!saveFeedback($feedback)) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'Failed to save feedback. Check file permissions.']);
        exit;
    }

    echo json_encode(['ok' => true, 'id' => $entry['id']], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
