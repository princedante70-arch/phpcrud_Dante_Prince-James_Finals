<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome!</h1>
    <p>You have logged in successfully.</p>
    <a href="indexc.php">Open student records</a>
    <a href="logout.php">Log out</a>
</body>
</html>
