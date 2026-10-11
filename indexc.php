<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// indexc.php - the students dashboard
include 'database.php';

// READ: get all rows from the students table
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id ASC");

if ($result === false) {
    die('Could not load students: ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>

    <!-- Bootstrap CSS (CDN via jsDelivr) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (CDN via jsDelivr) - required for the modals to work -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Students</h1>
            <a href="logout.php" class="btn btn-outline-danger">Log out</a>
        </div>

        <!-- CREATE: button that opens the add modal (id="add") -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add">
            Add New Student
        </button>

        <!-- ADD MODAL -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- The <form> is inside modal-content and closes after the modal-footer -->
                    <form action="insert.php" method="post">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addLabel">Add New Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Firstname</label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lastname</label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- LAYOUT + TABLE -->
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <!-- Print the database values inside the <td> tags -->
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>

                            <td>
                                <!-- UPDATE: Edit button. The target changes per row (#edit1, #edit2, ...) -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id']; ?>">
                                    Edit
                                </button>

                                <!-- EDIT MODAL (every row has its own modal) -->
                                <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="update.php" method="post">

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editLabel<?php echo $row['id']; ?>">Edit Student</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- Hidden input so update.php knows which id to update -->
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- DELETE: link to delete.php with the row's id -->
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>