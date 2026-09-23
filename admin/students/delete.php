<?php

include("../admin_auth.php");
include("../../config/database.php");

// Check student ID
if (!isset($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$student_id = intval($_GET['id']);

// Delete student
$query = "DELETE FROM students WHERE student_id = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $student_id);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: view.php");
    exit();

} else {

    die("Error deleting student: " . mysqli_error($conn));

}
?>