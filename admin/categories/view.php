  <?php

include("../admin_auth.php");
include("../../config/database.php");

$query = "SELECT
            category_id,
            category_name
          FROM categories
          ORDER BY category_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching categories: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Categories - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container mt-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Categories</h2>

        <div>

            <a href="add.php" class="btn btn-success">
                Add Category
            </a>

            <a href="../dashboard.php" class="btn btn-dark">
                Back to Dashboard
            </a>

        </div>

    </div>


    <!-- Categories Table -->

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Category Name</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                <?php while ($category = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $category['category_id']; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $category['category_name']
                            );
                            ?>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?php echo $category['category_id']; ?>"
                                class="btn btn-warning btn-sm"
                            >
                                Edit
                            </a>

                            <a
                                href="delete.php?id=<?php echo $category['category_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to permanently delete this category?');"
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
            No categories available.
        </div>

    <?php } ?>

</div>

</body>

</html>