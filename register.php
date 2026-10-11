<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'database.php';

    $username = trim($_POST['username'] ?? '');
    $passwordInput = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($username === '' || $passwordInput === '' || $confirmPassword === '') {
        exit('Please complete all fields.');
    }

    if ($passwordInput !== $confirmPassword) {
        exit('Passwords do not match.');
    }

    $check = mysqli_prepare($conn, 'SELECT 1 FROM students WHERE username = ? LIMIT 1');
    if ($check === false) {
        exit('Account check could not be prepared: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($check, 's', $username);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        mysqli_stmt_close($check);
        exit('That username already exists.');
    }
    mysqli_stmt_close($check);

    $stmt = mysqli_prepare($conn, 'INSERT INTO students (username, `password`) VALUES (?, ?)');
    if ($stmt === false) {
        exit('Account could not be prepared: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $username, $passwordInput);
    if (!mysqli_stmt_execute($stmt)) {
        $error = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        exit('Account could not be created: ' . $error);
    }

    mysqli_stmt_close($stmt);
    echo "<script>
        alert('Account created successfully. You can now log in.');
        window.location='login.php';
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="center">CREATE ACCOUNT</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm password" required>
            <button type="submit">CREATE ACCOUNT</button>
        </form>
        <a href="index.php">Already have an account? Log in</a>
    </div>
</body>
</html>
