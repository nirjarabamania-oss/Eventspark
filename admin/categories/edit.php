<?php

include("../admin_auth.php");
include("../../config/database.php");

if (!isset($_GET['id'])) {

    header("Location: view.php");
    exit();

}

$category_id = intval($_GET['id']);

$error = "";

/*
 * Fetch category
 */

$query = "SELECT category_name
          FROM categories
          WHERE category_id = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) != 1) {

    mysqli_stmt_close($stmt);

    header("Location: view.php");
    exit();

}

$category = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/*
 * Update category
 */

if (isset($_POST['update_category'])) {

    $category_name = trim($_POST['category_name']);

    if ($category_name == "") {

        $error = "Category name is required.";

    } else {

        $query = "UPDATE categories
                  SET category_name = ?
                  WHERE category_id = ?";

        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Error preparing update query: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $category_name,
            $category_id
        );

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);

            header("Location: view.php");
            exit();

        } else {

            $error = "Error updating category: " . mysqli_error($conn);
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

    <title>Edit Category - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Edit Category</h2>

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
                        value="<?php echo htmlspecialchars($category['category_name']); ?>"
                        required
                    >

                </div>

                <button
                    type="submit"
                    name="update_category"
                    class="btn btn-primary"
                >
                    Update Category
                </button>

            </form>

        </div>

    </div>

</div>

</body>

</html>