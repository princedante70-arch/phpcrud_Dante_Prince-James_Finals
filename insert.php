<?php
// insert.php - CREATE: adds a new student to the database
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the values from the form (name="firstname" and name="lastname")
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');

    if ($firstname !== '' && $lastname !== '') {
        // Prepared statement: safer against SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO students (firstname, lastname) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $firstname, $lastname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Go back to the main page
header("Location: indexc.php");
exit;