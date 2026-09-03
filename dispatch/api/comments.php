<?php
// api/comments.php — Shared comments API for DISPATCH tutorials
// Stores comments in data/comments.json (no database required).

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_ORIGIN'] ?? ''));
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

define('COMMENTS_FILE', __DIR__ . '/../data/comments.json');
define('RATE_FILE', __DIR__ . '/../data/comment_rate.json');
define('MAX_COMMENTS', 500);
define('MAX_NAME_LEN', 50);
define('MAX_MSG_LEN', 1000);
define('MIN_MSG_LEN', 3);
define('EDIT_WINDOW', 900);
define('HARD_DELETE_DAYS', 30);
define('RATE_COMMENT_PER_MIN', 5);
define('RATE_REACT_PER_MIN', 20);

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
    $now = time();
    $cleaned = [];
    foreach ($comments as $c) {
        if (!empty($c['deleted']) && isset($c['deleted_at']) && ($now - $c['deleted_at']) > HARD_DELETE_DAYS * 86400) continue;
        $cleaned[] = $c;
    }
    $cleaned = array_slice($cleaned, 0, MAX_COMMENTS);
    $tmp = COMMENTS_FILE . '.tmp';
    $json = json_encode($cleaned, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (@file_put_contents($tmp, $json) === false) return false;
    return @rename($tmp, COMMENTS_FILE);
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
    return $_SERVER['REMOTE_ADDR'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '0.0.0.0';
}

function checkRateLimit(string $bucket, int $maxPerMin): bool {
    $data = [];
    if (file_exists(RATE_FILE)) {
        $raw = @file_get_contents(RATE_FILE);
        if ($raw !== false) $data = json_decode($raw, true) ?: [];
    }
    $ip = getClientIP();
    $key = $ip . ':' . $bucket;
    $now = time();
    $entries = $data[$key] ?? [];
    $entries = array_values(array_filter($entries, function($t) use ($now) { return ($now - $t) < 60; }));
    if (count($entries) >= $maxPerMin) {
        $data[$key] = $entries;
        @file_put_contents(RATE_FILE, json_encode($data));
        return false;
    }
    $entries[] = $now;
    $data[$key] = $entries;
    $dir = dirname(RATE_FILE);
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    @file_put_contents(RATE_FILE, json_encode($data));
    return true;
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

function isValidName(string $name): bool {
    if ($name === '') return true;
    if (preg_match('/<[^>]+>/', $name)) return false;
    if (preg_match('#https?://#i', $name)) return false;
    if (preg_match('/\bwww\./i', $name)) return false;
    return true;
}

function isValidMessage(string $msg): bool {
    if (mb_strlen(trim($msg)) < MIN_MSG_LEN) return false;
    return true;
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
    usort($threaded, function($a, $b) use ($parentId) {
        if ($parentId === null) {
            $aPinned = !empty($a['pinned']);
            $bPinned = !empty($b['pinned']);
            if ($aPinned && !$bPinned) return -1;
            if ($bPinned && !$aPinned) return 1;
            return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
        }
        return ($a['timestamp'] ?? 0) <=> ($b['timestamp'] ?? 0);
    });
    return $threaded;
}

function sortThreaded(array $threaded, string $sort): array {
    if ($sort === 'oldest') {
        usort($threaded, function($a, $b) {
            $aPinned = !empty($a['pinned']);
            $bPinned = !empty($b['pinned']);
            if ($aPinned && !$bPinned) return -1;
            if ($bPinned && !$aPinned) return 1;
            return ($a['timestamp'] ?? 0) <=> ($b['timestamp'] ?? 0);
        });
    } elseif ($sort === 'top') {
        usort($threaded, function($a, $b) {
            $aPinned = !empty($a['pinned']);
            $bPinned = !empty($b['pinned']);
            if ($aPinned && !$bPinned) return -1;
            if ($bPinned && !$aPinned) return 1;
            $aScore = ($a['likes'] ?? 0) - ($a['dislikes'] ?? 0);
            $bScore = ($b['likes'] ?? 0) - ($b['dislikes'] ?? 0);
            if ($aScore !== $bScore) return $bScore <=> $aScore;
            return ($b['timestamp'] ?? 0) <=> ($a['timestamp'] ?? 0);
        });
    }
    return $threaded;
}

function stripPrivate(array $all): array {
    return array_map(function($c) {
        unset($c['edit_token']);
        if (!isset($c['reactions']) || !is_array($c['reactions'])) $c['reactions'] = [];
        if (!isset($c['dislikes'])) $c['dislikes'] = 0;
        if (!isset($c['pinned'])) $c['pinned'] = false;
        if (!isset($c['hearted'])) $c['hearted'] = false;
        if (!isset($c['deleted'])) $c['deleted'] = false;
        return $c;
    }, $all);
}

function recomputeCounts(array &$comments): void {
    foreach ($comments as &$c) {
        $reactions = $c['reactions'] ?? [];
        $likes = 0; $dislikes = 0;
        foreach ($reactions as $type) {
            if ($type === 'like') $likes++;
            elseif ($type === 'dislike') $dislikes++;
        }
        $c['likes'] = $likes;
        $c['dislikes'] = $dislikes;
    }
    unset($c);
}

// --- Main ---

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $videoId = $_GET['video_id'] ?? '';
    $sort = $_GET['sort'] ?? 'newest';
    $all = loadComments();
    if ($videoId !== '') {
        $all = array_values(array_filter($all, function($c) use ($videoId) {
            return ($c['video_id'] ?? '') === $videoId;
        }));
    }
    $showReported = isset($_GET['show_reported']) && $_GET['show_reported'] === '1';
    if (!$showReported) {
        $all = array_values(array_filter($all, function($c) {
            return empty($c['reported']);
        }));
    }
    if (isset($_GET['action']) && $_GET['action'] === 'count') {
        $latest = 0;
        $latestName = '';
        $latestMsg = '';
        foreach ($all as $c) {
            if (($c['timestamp'] ?? 0) > $latest) {
                $latest = $c['timestamp'] ?? 0;
                $latestName = $c['name'] ?? '';
                $latestMsg = $c['message'] ?? '';
            }
        }
        echo json_encode(['ok' => true, 'count' => count($all), 'latest_timestamp' => $latest, 'latest_name' => $latestName, 'latest_message' => mb_substr($latestMsg, 0, 80)], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $all = stripPrivate($all);
    $threaded = buildThreaded($all);
    if ($sort !== 'newest') {
        $threaded = sortThreaded($threaded, $sort);
    }
    echo json_encode(['ok' => true, 'comments' => $threaded, 'count' => count($all)], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input)) $input = $_POST;

    $action = $input['action'] ?? 'add';

    if ($action === 'add') {
        if (!checkRateLimit('comment', RATE_COMMENT_PER_MIN)) {
            http_response_code(429);
            echo json_encode(['ok' => false, 'error' => 'You are commenting too quickly. Please wait a moment.']);
            exit;
        }
        $name = clean($input['name'] ?? 'Anonymous', MAX_NAME_LEN);
        if ($name === '') $name = 'Anonymous';
        if (!isValidName($name)) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Invalid name.']);
            exit;
        }
        $message = clean($input['message'] ?? '', MAX_MSG_LEN);
        if (!isValidMessage($message)) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Message must be at least ' . MIN_MSG_LEN . ' characters.']);
            exit;
        }
        $videoId = clean($input['video_id'] ?? '', 100);
        $parentId = $input['parent_id'] ?? null;
        if ($parentId === '') $parentId = null;

        $comment = [
            'id' => genId(),
            'video_id' => $videoId,
            'parent_id' => $parentId,
            'name' => $name,
            'message' => $message,
            'avatar_color' => avatarColor($name),
            'likes' => 0,
            'dislikes' => 0,
            'reactions' => [],
            'pinned' => false,
            'hearted' => false,
            'deleted' => false,
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
        unset($comment['edit_token']);
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
        if (!isValidMessage($newMessage)) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Message must be at least ' . MIN_MSG_LEN . ' characters.']);
            exit;
        }

        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                $storedToken = $c['edit_token'] ?? '';
                if ($storedToken !== '' && $storedToken !== $editToken) {
                    http_response_code(403);
                    echo json_encode(['ok' => false, 'error' => 'You can only edit your own comments.']);
                    exit;
                }
                if ((time() - ($c['timestamp'] ?? 0)) > EDIT_WINDOW) {
                    http_response_code(403);
                    echo json_encode(['ok' => false, 'error' => 'Edit window has expired.']);
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

    if ($action === 'delete') {
        $commentId = clean($input['id'] ?? '', 64);
        $editToken = clean($input['edit_token'] ?? '', 64);
        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                $storedToken = $c['edit_token'] ?? '';
                if ($storedToken !== '' && $storedToken !== $editToken) {
                    http_response_code(403);
                    echo json_encode(['ok' => false, 'error' => 'You can only delete your own comments.']);
                    exit;
                }
                $c['deleted'] = true;
                $c['deleted_at'] = time();
                $c['message'] = '';
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

    if ($action === 'react' || $action === 'like' || $action === 'dislike') {
        if (!checkRateLimit('react', RATE_REACT_PER_MIN)) {
            http_response_code(429);
            echo json_encode(['ok' => false, 'error' => 'Too many reactions. Please slow down.']);
            exit;
        }
        $commentId = clean($input['id'] ?? '', 64);
        $userId = clean($input['user_id'] ?? '', 64);
        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        if ($userId === '') $userId = getClientIP();

        if ($action === 'like') $reactType = $input['type'] ?? 'like';
        elseif ($action === 'dislike') $reactType = 'dislike';
        else $reactType = $input['type'] ?? 'like';

        if (!in_array($reactType, ['like', 'dislike', 'none'], true)) $reactType = 'like';

        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if ($c['id'] === $commentId) {
                if (!isset($c['reactions']) || !is_array($c['reactions'])) $c['reactions'] = [];
                if ($reactType === 'none') {
                    unset($c['reactions'][$userId]);
                } else {
                    $current = $c['reactions'][$userId] ?? null;
                    if ($current === $reactType) {
                        unset($c['reactions'][$userId]);
                    } else {
                        $c['reactions'][$userId] = $reactType;
                    }
                }
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
        recomputeCounts($comments);
        saveComments($comments);
        $target = array_values(array_filter($comments, function($c) use ($commentId) { return $c['id'] === $commentId; }));
        $t = $target[0] ?? null;
        echo json_encode(['ok' => true, 'likes' => $t['likes'] ?? 0, 'dislikes' => $t['dislikes'] ?? 0], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($action === 'heart') {
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
                $c['hearted'] = !($c['hearted'] ?? false);
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
        $target = array_values(array_filter($comments, function($c) use ($commentId) { return $c['id'] === $commentId; }));
        echo json_encode(['ok' => true, 'hearted' => $target[0]['hearted'] ?? false], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($action === 'pin') {
        $commentId = clean($input['id'] ?? '', 64);
        $videoId = clean($input['video_id'] ?? '', 100);
        if ($commentId === '') {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Missing comment id.']);
            exit;
        }
        $comments = loadComments();
        $found = false;
        foreach ($comments as &$c) {
            if (!empty($c['pinned']) && ($c['video_id'] ?? '') === $videoId) {
                $c['pinned'] = false;
            }
            if ($c['id'] === $commentId) {
                $c['pinned'] = !($c['pinned'] ?? false);
                $found = true;
            }
        }
        unset($c);
        if (!$found) {
            http_response_code(404);
            echo json_encode(['ok' => false, 'error' => 'Comment not found.']);
            exit;
        }
        saveComments($comments);
        $target = array_values(array_filter($comments, function($c) use ($commentId) { return $c['id'] === $commentId; }));
        echo json_encode(['ok' => true, 'pinned' => $target[0]['pinned'] ?? false], JSON_UNESCAPED_UNICODE);
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
