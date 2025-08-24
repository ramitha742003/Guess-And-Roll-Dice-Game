<?php
session_start();
include 'db.php';

$game_id = $_SESSION['game_id'] ?? null;
if ($game_id) {
    $stmt = $conn->prepare("UPDATE game_records SET logout_datetime = NOW() WHERE id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
}

session_destroy();
header("Location: login.html");
exit;
?>
