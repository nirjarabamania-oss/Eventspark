<?php

include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

if (!isset($_GET['id'])) {

    header("Location: view.php");
    exit();

}

$image_id = intval($_GET['id']);


// Get image belonging to this college

$sql = "SELECT image
        FROM college_gallery
        WHERE image_id = ?
        AND college_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $image_id,
    $college_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$image = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Image not found

if (!$image) {

    header("Location: view.php");
    exit();

}


// Delete database record

$sql = "DELETE FROM college_gallery
        WHERE image_id = ?
        AND college_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $image_id,
    $college_id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


// Delete actual image

$filePath =
    "../../assets/uploads/colleges/gallery/" .
    $image['image'];

if (file_exists($filePath)) {

    unlink($filePath);

}


header("Location: view.php");

exit();

?>