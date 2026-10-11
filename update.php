<?php
// update.php - UPDATE: changes the firstname and lastname of a student
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Values come from the hidden input (name="id") and the two text inputs
    $id        = (int) ($_POST['id'] ?? 0);
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');

    if ($id > 0 && $firstname !== '' && $lastname !== '') {
        $stmt = mysqli_prepare($conn, "UPDATE students SET firstname = ?, lastname = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $firstname, $lastname, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Go back to the main page
header("Location: indexc.php");
exit;