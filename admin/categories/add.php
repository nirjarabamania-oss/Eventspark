<?php

include("../admin_auth.php");
include("../../config/database.php");

$error = "";

if (isset($_POST['add_category'])) {

    $category_name = trim($_POST['category_name']);

    if ($category_name == "") {
        $error = "Category name is required.";
    } else {

        $query = "INSERT INTO categories (category_name) VALUES (?)";

        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Error preparing query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "s", $category_name);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: view.php");
            exit();
        } else {
            $error = "Error adding category: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Category - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add Category</h2>

        <a href="view.php" class="btn btn-dark">
            Back to Categories
        </a>
    </div>

    <?php if ($error != "") { ?>

        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php } ?>

    <div class="card shadow">

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Category Name
                    </label>

                    <input
                        type="text"
                        name="category_name"
                        class="form-control"
                        placeholder="Enter category name"
                        required
                    >

                </div>

                <button
                    type="submit"
                    name="add_category"
                    class="btn btn-success"
                >
                    Add Category
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>