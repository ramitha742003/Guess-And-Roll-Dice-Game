<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if ($password !== $confirm) {
    echo "Passwords do not match.";
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Username already exists.";
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed);

if ($stmt->execute()) {
    header("Location: login.html");
} else {
    echo "Error creating account.";
}
?>
