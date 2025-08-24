<?php
session_start();
include 'db.php';

$score = $_POST['score'] ?? 0;
$game_id = $_SESSION['game_id'] ?? null;

if ($game_id) {
    $stmt = $conn->prepare("UPDATE game_records SET score = ? WHERE id = ?");
    $stmt->bind_param("ii", $score, $game_id);
    $stmt->execute();
    echo "Score updated.";
} else {
    echo "Session not found.";
}
?>
