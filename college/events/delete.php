<?php

include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

// Check event ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$event_id = (int) $_GET['id'];


// Fetch event only if it belongs to logged-in college
$sql = "SELECT poster
        FROM events
        WHERE event_id = ?
        AND college_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $event_id,
    $college_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$event = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Event doesn't exist or doesn't belong to this college
if (!$event) {
    header("Location: view.php");
    exit();
}


// Delete event from database
$delete_sql = "DELETE FROM events
               WHERE event_id = ?
               AND college_id = ?";

$delete_stmt = mysqli_prepare(
    $conn,
    $delete_sql
);

mysqli_stmt_bind_param(
    $delete_stmt,
    "ii",
    $event_id,
    $college_id
);

if (mysqli_stmt_execute($delete_stmt)) {

    // Delete poster file
    if (!empty($event['poster'])) {

        $poster_path =
            "../../assets/uploads/events/" .
            $event['poster'];

        if (file_exists($poster_path)) {
            unlink($poster_path);
        }
    }
}

mysqli_stmt_close($delete_stmt);


// Return to events page
header("Location: view.php");
exit();

?>