<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Authentication required.']);
    exit;
}

$userId = (int) $_SESSION['user_id'];

$pdo->exec("CREATE TABLE IF NOT EXISTS ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    song_title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    rating TINYINT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY user_song_unique (user_id, song_title),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'saveRating') {
    $songTitle = trim($_POST['song_title'] ?? '');
    $artist = trim($_POST['artist'] ?? '');
    $rating = (int) ($_POST['rating'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    if (!$songTitle || !$artist || $rating < 1 || $rating > 5) {
        echo json_encode(['success' => false, 'message' => 'Please provide a song, artist, and rating between 1 and 5.']);
        exit;
    }

    $stmt = $pdo->prepare('INSERT INTO ratings (user_id, song_title, artist, rating, comment)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE rating = VALUES(rating), comment = VALUES(comment), updated_at = CURRENT_TIMESTAMP');
    $stmt->execute([$userId, $songTitle, $artist, $rating, $comment]);

    echo json_encode(['success' => true, 'message' => 'Your rating has been saved.']);
    exit;
}

if ($action === 'getRatings') {
    $stmt = $pdo->prepare('SELECT song_title, artist, rating, comment FROM ratings WHERE user_id = ? ORDER BY updated_at DESC');
    $stmt->execute([$userId]);
    $ratings = $stmt->fetchAll();
    echo json_encode(['success' => true, 'ratings' => $ratings]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action.']);
