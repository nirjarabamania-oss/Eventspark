<?php

include("../admin_auth.php");
include("../../config/database.php");

// Check event ID
if (!isset($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$event_id = intval($_GET['id']);

// First get poster filename
$query = "SELECT poster FROM events WHERE event_id = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Delete event
$query = "DELETE FROM events WHERE event_id = ?";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing delete query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $event_id);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    // Delete poster file if it exists
    if (!empty($event['poster'])) {

        $poster_path = "../../assets/uploads/events/" . $event['poster'];

        if (file_exists($poster_path)) {
            unlink($poster_path);
        }
    }

    header("Location: view.php");
    exit();

} else {

    die("Error deleting event: " . mysqli_error($conn));

}

?>