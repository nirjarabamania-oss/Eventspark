<?php

include("../admin_auth.php");
include("../../config/database.php");

// Check college ID
if (!isset($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$college_id = intval($_GET['id']);

// Delete college
$query = "DELETE FROM colleges 
          WHERE college_id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $college_id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: view.php");
    exit();
} else {
    die("Error deleting college: " . mysqli_error($conn));
}
?>