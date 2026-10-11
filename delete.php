<?php
// delete.php - DELETE: removes a student using the id in the link (delete.php?id=...)
include 'database.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Go back to the main page
header("Location: indexc.php");
exit;