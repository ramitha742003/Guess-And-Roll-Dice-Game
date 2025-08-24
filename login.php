<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $hashed);
    $stmt->fetch();

    if (password_verify($password, $hashed)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;

        $stmt2 = $conn->prepare("INSERT INTO game_records (user_id, user_name) VALUES (?, ?)");
        $stmt2->bind_param("is", $id, $username);
        $stmt2->execute();
        $_SESSION['game_id'] = $stmt2->insert_id;

        header("Location: index.php");
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}
?>
