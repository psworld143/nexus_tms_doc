<?php
// api/comments.php — Shared comments API for DISPATCH tutorials
// Stores comments in data/comments.json (no database required).

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

// CORS: same-origin only
header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_ORIGIN'] ?? ''));
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

define('COMMENTS_FILE', __DIR__ . '/../data/comments.json');
define('MAX_COMMENTS', 500);
define('MAX_NAME_LEN', 50);
define('MAX_MSG_LEN', 1000);

// --- Helpers ---

function loadComments(): array {
    if (!file_exists(COMMENTS_FILE)) return [];
    $raw = @file_get_contents(COMMENTS_FILE);
    if ($raw === false) return [];
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function saveComments(array $comments): bool {
    $dir = dirname(COMMENTS_FILE);
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    // Atomic write: temp file + rename
    $tmp = COMMENTS_FILE . '.tmp';
    $json = json_encode(array_slice($comments, 0, MAX_COMMENTS), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (@file_put_contents($tmp, $json) === false) return false;
    return @rename($tmp, COMMENTS_FILE);
}

function clean(string $s, int $max): string {
    $s = trim($s);
    if (mb_strlen($s) > $max) $s = mb_substr($s, 0, $max);
    return $s;
}

function genId(): string {
    return bin2hex(random_bytes(8)) . dechex(time());
}

function avatarColor(string $name): string {
    $colors = [
        '#10b981', '#3b82f6', '#8b5cf6', '#ec4899',
        '#f59e0b', '#ef4444', '#06b6d4', '#84cc16',
        '#f97316', '#6366f1', '#14b8a6', '#e11d48'
    ];
    $hash = 0;
    for ($i = 0; $i < mb_strlen($name); $i++) {
        $hash = ($hash * 31 + ord($name[$i])) & 0x7fffffff;
    }
    return $colors[$hash % count($colors)];
}

function escapeHtml(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function buildThreaded(array $all, ?string $parentId = null): array {
    $threaded = [];
    foreach ($all as $c) {
        $pid = $c['parent_id'] ?? null;
        if ($pid === $parentId) {
            $c['replies'] = buildThreaded($all, $c['id']);
            $threaded[] = $c;
        }
    }
    // Sort: top-level by newest first, replies by oldest first
    usort($threaded, function($a, $b) use ($parentId) {
        if ($parentId === null) return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
        return ($a['timestamp'] ?? 0) <=> ($b['timestamp'] ?? 0);
    });
    return $threaded;
}

// --- Main ---

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $videoId = $_GET['video_id'] ?? '';
    $all = loadComments();
    // Filter by video_id if provided
    if ($videoId !== '') {
        $all = array_values(array_filter($all, function($c) use ($videoId) {
            return ($c['video_id'] ?? '') === $videoId;
        }));
    }
    // Hide reported comments (unless show_reported=1)
    $showReported = isset($_GET['show_reported']) && $_GET['show_reported'] === '1';
    if (!$showReported) {
        $all = array_values(array_filter($all, function($c) {
            return empty($c['reported']);
        }));
    }
    // Strip edit_token from response (security — don't expose tokens)
    $all = array_map(function($c) {
        unset($c['edit_token']);
        return $c;
    }, $all);
    $threaded = buildThreaded($all);
    // Lightweight count endpoint for notification polling
    if (isset($_GET['action']) && $_GET['action'] === 'count') {
        // Get latest comment timestamp
        $latest = 0;
        $latestName = '';
        foreach ($all as $c) {
            if (($c['timestamp'] ?? 0) > $latest) { $latest = $c['timestamp'] ?? 0; $latestName = $c['name'] ?? ''; }
        }
        echo json_encode(['ok' => true, 'count' => count($all), 'latest_timestamp' => $latest, 'latest_name' => $latestName], JSON_UNESCAPED_UNICODE);
        exit;
    }
    echo json_encode(['ok' => true, 'comments' => $threaded, 'count' => count($all)], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input)) $input = $_POST;

    $action = $input['action'] ?? 'add';

    if ($action === 'add') {
        $name = clean($input['name'] ?? 'Anonymous', MAX_NAME_LEN);
        $message = clean($input['message'] ?? '', MAX_MSG_LEN);
        $videoId = clean($input['video_id'] ?? '', 100);
        $parentId = $input['parent_id'] ?? null;
        if ($parentId === '') $parentId = null;

        if ($message === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Message cannot be empty.']);
            exit;
        }

        $comment = [
            'id' => genId(),
            'video_id' => $videoId,
            'parent_id' => $parentId,
            'name' => $name,
            'message' => $message,
            'avatar_color' => avatarColor($name),
            'likes' => 0,
            'reported' => false,
            'timestamp' => time(),
            'edit_token' => bin2hex(random_bytes(16)),
            'edited' => false
        ];

        $comments = loadComments();
        $comments[] = $comment;
        if (!saveComments($comments)) {
            http_response_code(500);
            echo json_encode(['ok' => false, 'error' => 'Failed to save comment. Check file permissions.']);
            exit;
        }
        echo json_encode(['ok' => true, 'comment' => $comment], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($action === 'edit') {
        $commentId = clean($input['id'] ?? '', 64);
        $editToken = clean($input['edit_token'] ?? '', 64);
        $newMessage = clean($input['message'] ?? '', MAX_MSG_LEN);

        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        if ($newMessage === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Message cannot be empty.']);
            exit;
        }

        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                // Verify edit token only if the comment has one (old comments don't)
                $storedToken = $c['edit_token'] ?? '';
                if ($storedToken !== '' && $storedToken !== $editToken) {
                    http_response_code(403);
                    echo json_encode(['ok' => false, 'error' => 'You can only edit your own comments.']);
                    exit;
                }
                $c['message'] = $newMessage;
                $c['edited'] = true;
                $c['edited_at'] = time();
                $found = true;
                break;
            }
        }
        unset($c);
        if (!$found) {
            http_response_code(404);
            echo json_encode(['ok' => false, 'error' => 'Comment not found.']);
            exit;
        }
        saveComments($comments);
        echo json_encode(['ok' => true], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($action === 'like') {
        $commentId = clean($input['id'] ?? '', 64);
        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                $c['likes'] = ($c['likes'] ?? 0) + 1;
                $found = true;
                break;
            }
        }
        unset($c);
        if (!$found) {
            http_response_code(404);
            echo json_encode(['ok' => false, 'error' => 'Comment not found.']);
            exit;
        }
        saveComments($comments);
        $liked = array_values(array_filter($comments, function($c) use ($commentId) { return $c['id'] === $commentId; }));
        echo json_encode(['ok' => true, 'likes' => $liked[0]['likes'] ?? 0], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($action === 'report') {
        $commentId = clean($input['id'] ?? '', 64);
        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                $c['reported'] = true;
                $found = true;
                break;
            }
        }
        unset($c);
        if (!$found) {
            http_response_code(404);
            echo json_encode(['ok' => false, 'error' => 'Comment not found.']);
            exit;
        }
        saveComments($comments);
        echo json_encode(['ok' => true], JSON_UNESCAPED_UNICODE);
        exit;
    }

    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Unknown action.']);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Method not allowed.']);
