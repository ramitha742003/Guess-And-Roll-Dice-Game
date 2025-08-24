<?php
session_start();
include 'db.php';

$game_id = $_SESSION['game_id'] ?? null;
$result = $_POST['result'] ?? '';

if ($game_id && ($result === 'win' || $result === 'lose')) {
    $stmt = $conn->prepare("UPDATE game_records SET result = ?, logout_datetime = NOW() WHERE id = ?");
    $stmt->bind_param("si", $result, $game_id);
    $stmt->execute();
    echo "Result saved.";
} else {
    echo "Error saving result.";
}
?>
