<?php

include("../admin_auth.php");
include("../../config/database.php");

if (!isset($_GET['id'])) {

    header("Location: view.php");
    exit();

}

$category_id = intval($_GET['id']);

$query = "DELETE FROM categories
          WHERE category_id = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing delete query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $category_id);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: view.php");
    exit();

} else {

    die("Error deleting category: " . mysqli_error($conn));
}

?>