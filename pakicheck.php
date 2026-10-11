<?php

session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$passwordInput = $_POST['password'] ?? '';

if ($username === '' || $passwordInput === '') {
    exit('Please enter your username and password.');
}

$stmt = mysqli_prepare(
    $conn,
    'SELECT 1 FROM students WHERE username = ? AND `password` = ? LIMIT 1'
);

if ($stmt === false) {
    exit('Login query could not be prepared: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'ss', $username, $passwordInput);

if (!mysqli_stmt_execute($stmt)) {
    $error = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    exit('Login query failed: ' . $error);
}

mysqli_stmt_store_result($stmt);
$validLogin = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);

if (!$validLogin) {
    echo "<script>
        alert('Incorrect username or password.');
        window.location='index.php';
    </script>";
    exit;
}

session_regenerate_id(true);
$_SESSION['username'] = $username;

header('Location: indexc.php');
exit;
