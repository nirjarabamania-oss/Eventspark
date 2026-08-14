<?php
include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

$message = "";
$message_type = "";

// Check event ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$event_id = (int) $_GET['id'];

// Fetch event belonging to logged-in college
$sql = "SELECT * FROM events
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

// Event not found or does not belong to this college
if (!$event) {
    header("Location: view.php");
    exit();
}


// Fetch categories
$category_sql = "SELECT category_id, category_name
                 FROM categories
                 ORDER BY category_name ASC";

$category_result = mysqli_query($conn, $category_sql);


// Update event
if (isset($_POST['update_event'])) {

    $category_id = $_POST['category_id'];
    $event_title = trim($_POST['event_title']);
    $description = trim($_POST['description']);
    $venue = trim($_POST['venue']);
    $city = trim($_POST['city']);
    $event_date = $_POST['event_date'];

    $start_time = !empty($_POST['start_time'])
        ? $_POST['start_time']
        : NULL;

    $end_time = !empty($_POST['end_time'])
        ? $_POST['end_time']
        : NULL;

    $registration_deadline = !empty($_POST['registration_deadline'])
        ? $_POST['registration_deadline']
        : NULL;

    $max_participants = !empty($_POST['max_participants'])
        ? $_POST['max_participants']
        : NULL;

    $registration_fee = !empty($_POST['registration_fee'])
        ? $_POST['registration_fee']
        : 0;

    $status = $_POST['status'];

    // Keep existing poster
    $poster_name = $event['poster'];

    $poster_folder = "../../assets/uploads/events/";

    $allowed_extensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];


    // New poster upload
    if (
        isset($_FILES['poster']) &&
        $_FILES['poster']['error'] === 0
    ) {

        $poster_extension = strtolower(
            pathinfo(
                $_FILES['poster']['name'],
                PATHINFO_EXTENSION
            )
        );

        if (in_array($poster_extension, $allowed_extensions)) {

            if (!is_dir($poster_folder)) {
                mkdir($poster_folder, 0777, true);
            }

            $new_poster_name =
                uniqid('event_') . '.' . $poster_extension;

            if (
                move_uploaded_file(
                    $_FILES['poster']['tmp_name'],
                    $poster_folder . $new_poster_name
                )
            ) {

                // Delete old poster
                if (
                    !empty($poster_name) &&
                    file_exists($poster_folder . $poster_name)
                ) {
                    unlink($poster_folder . $poster_name);
                }

                $poster_name = $new_poster_name;
            }
        }
    }


    // Update database
    $update_sql = "UPDATE events SET
                    category_id = ?,
                    event_title = ?,
                    description = ?,
                    venue = ?,
                    city = ?,
                    event_date = ?,
                    start_time = ?,
                    end_time = ?,
                    registration_deadline = ?,
                    max_participants = ?,
                    registration_fee = ?,
                    poster = ?,
                    status = ?
                   WHERE event_id = ?
                   AND college_id = ?";

    $update_stmt = mysqli_prepare(
        $conn,
        $update_sql
    );

    mysqli_stmt_bind_param(
        $update_stmt,
        "issssssssidssii",
        $category_id,
        $event_title,
        $description,
        $venue,
        $city,
        $event_date,
        $start_time,
        $end_time,
        $registration_deadline,
        $max_participants,
        $registration_fee,
        $poster_name,
        $status,
        $event_id,
        $college_id
    );


    if (mysqli_stmt_execute($update_stmt)) {

        $message = "Event updated successfully.";
        $message_type = "success";

        // Refresh event data
        $refresh_sql = "SELECT * FROM events
                        WHERE event_id = ?
                        AND college_id = ?";

        $refresh_stmt = mysqli_prepare(
            $conn,
            $refresh_sql
        );

        mysqli_stmt_bind_param(
            $refresh_stmt,
            "ii",
            $event_id,
            $college_id
        );

        mysqli_stmt_execute($refresh_stmt);

        $refresh_result =
            mysqli_stmt_get_result($refresh_stmt);

        $event =
            mysqli_fetch_assoc($refresh_result);

        mysqli_stmt_close($refresh_stmt);

    } else {

        $message = "Failed to update event.";
        $message_type = "danger";
    }

    mysqli_stmt_close($update_stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Edit Event - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .event-card {
            border: none;
            border-radius: 12px;
        }

        .current-poster {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="mb-3">

        <a
            href="view.php"
            class="btn btn-dark">

            ← Back to Events

        </a>

    </div>


    <div class="card event-card shadow">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">
                Edit Event
            </h4>

        </div>


        <div class="card-body p-4">

            <?php if ($message != "") { ?>

                <div
                    class="alert alert-<?php echo $message_type; ?>">

                    <?php
                    echo htmlspecialchars($message);
                    ?>

                </div>

            <?php } ?>


            <form
                method="POST"
                enctype="multipart/form-data">


                <!-- Event Title -->

                <div class="mb-3">

                    <label class="form-label">
                        Event Title *
                    </label>

                    <input
                        type="text"
                        name="event_title"
                        class="form-control"
                        maxlength="200"
                        value="<?php
                        echo htmlspecialchars(
                            $event['event_title']
                        );
                        ?>"
                        required>

                </div>


                <!-- Category -->

                <div class="mb-3">

                    <label class="form-label">
                        Category *
                    </label>

                    <select
                        name="category_id"
                        class="form-select"
                        required>

                        <option value="">
                            Select Category
                        </option>

                        <?php
                        while (
                            $category =
                            mysqli_fetch_assoc(
                                $category_result
                            )
                        ) {
                        ?>

                            <option
                                value="<?php
                                echo $category['category_id'];
                                ?>"
                                <?php
                                if (
                                    $category['category_id']
                                    == $event['category_id']
                                ) {
                                    echo "selected";
                                }
                                ?>>

                                <?php
                                echo htmlspecialchars(
                                    $category['category_name']
                                );
                                ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <!-- Description -->

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="5"><?php
                        echo htmlspecialchars(
                            $event['description'] ?? ''
                        );
                        ?></textarea>

                </div>


                <div class="row">

                    <!-- Venue -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Venue
                        </label>

                        <input
                            type="text"
                            name="venue"
                            class="form-control"
                            maxlength="200"
                            value="<?php
                            echo htmlspecialchars(
                                $event['venue'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- City -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            maxlength="100"
                            value="<?php
                            echo htmlspecialchars(
                                $event['city'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- Event Date -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Event Date *
                        </label>

                        <input
                            type="date"
                            name="event_date"
                            class="form-control"
                            value="<?php
                            echo htmlspecialchars(
                                $event['event_date']
                            );
                            ?>"
                            required>

                    </div>


                    <!-- Start Time -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Start Time
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            class="form-control"
                            value="<?php
                            echo htmlspecialchars(
                                $event['start_time'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- End Time -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            End Time
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            class="form-control"
                            value="<?php
                            echo htmlspecialchars(
                                $event['end_time'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- Registration Deadline -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Registration Deadline
                        </label>

                        <input
                            type="date"
                            name="registration_deadline"
                            class="form-control"
                            value="<?php
                            echo htmlspecialchars(
                                $event['registration_deadline'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- Maximum Participants -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Maximum Participants
                        </label>

                        <input
                            type="number"
                            name="max_participants"
                            class="form-control"
                            min="1"
                            value="<?php
                            echo htmlspecialchars(
                                $event['max_participants'] ?? ''
                            );
                            ?>">

                    </div>


                    <!-- Registration Fee -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Registration Fee
                        </label>

                        <input
                            type="number"
                            name="registration_fee"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="<?php
                            echo htmlspecialchars(
                                $event['registration_fee']
                            );
                            ?>">

                    </div>

                </div>


                <!-- Status -->

                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="Open"
                            <?php
                            if ($event['status'] === 'Open') {
                                echo "selected";
                            }
                            ?>>

                            Open

                        </option>

                        <option
                            value="Closed"
                            <?php
                            if ($event['status'] === 'Closed') {
                                echo "selected";
                            } ?>>

                            Closed

                        </option>

                    </select>

                </div>


                <!-- Poster -->

                <div class="mb-4">

                    <label class="form-label">
                        Event Poster
                    </label>

                    <?php if (!empty($event['poster'])) { ?>

                        <div class="mb-2">

                            <img
                                src="../../assets/uploads/events/<?php
                                echo htmlspecialchars(
                                    $event['poster']
                                );
                                ?>"
                                class="current-poster"
                                alt="Current Event Poster">

                        </div>

                    <?php } ?>

                    <input
                        type="file"
                        name="poster"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Leave empty to keep the current poster.
                    </small>

                </div>


                <!-- Buttons -->

                <button
                    type="submit"
                    name="update_event"
                    class="btn btn-dark">

                    Save Changes

                </button>

                <a
                    href="view.php"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>