<?php

include("../admin_auth.php");
include("../../config/database.php");

// Fetch all students
$query = "SELECT * FROM students ORDER BY student_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching students: " . mysqli_error($conn));
}

// Get all column names
$fields = mysqli_fetch_fields($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Students - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Students</h2>

        <a href="../dashboard.php" class="btn btn-dark">
            Back to Dashboard
        </a>

    </div>


    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <?php foreach ($fields as $field) { ?>

                            <?php
                            // Do not display password
                            if (strtolower($field->name) == 'password') {
                                continue;
                            }
                            ?>

                            <th>
                                <?php echo htmlspecialchars($field->name); ?>
                            </th>

                        <?php } ?>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php while ($student = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <?php foreach ($fields as $field) { ?>

                            <?php
                            $column = $field->name;

                            // Never display password
                            if (strtolower($column) == 'password') {
                                continue;
                            }
                            ?>

                            <td>
                                <?php
                                echo htmlspecialchars($student[$column] ?? '');
                                ?>
                            </td>

                        <?php } ?>

                        <td>

                            <a
                                href="delete.php?id=<?php echo $student['student_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to permanently delete this student?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } else { ?>

        <div class="alert alert-info">
            No students registered yet.
        </div>

    <?php } ?>

</div>

</body>
</html>