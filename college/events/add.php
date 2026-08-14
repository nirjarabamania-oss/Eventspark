<?php
include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

$message = "";
$message_type = "";

// Get categories
$category_sql = "SELECT * FROM categories ORDER BY category_name ASC";
$category_result = mysqli_query($conn, $category_sql);


// Add event
if (isset($_POST['add_event'])) {

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

    $poster_name = NULL;

    // Poster upload
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

        $allowed_extensions = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];

        if (in_array($poster_extension, $allowed_extensions)) {

            $poster_folder = "../../assets/uploads/events/";

            // Create folder if it does not exist
            if (!is_dir($poster_folder)) {
                mkdir($poster_folder, 0777, true);
            }

            $poster_name =
                uniqid('event_') . '.' . $poster_extension;

            move_uploaded_file(
                $_FILES['poster']['tmp_name'],
                $poster_folder . $poster_name
            );
        }
    }


    // Insert event
    $sql = "INSERT INTO events
            (
                college_id,
                category_id,
                event_title,
                description,
                venue,
                city,
                event_date,
                start_time,
                end_time,
                registration_deadline,
                max_participants,
                registration_fee,
                poster
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "iisssssssiids",
        $college_id,
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
        $poster_name
    );


    if (mysqli_stmt_execute($stmt)) {

        $message = "Event created successfully.";
        $message_type = "success";

    } else {

        $message = "Failed to create event.";
        $message_type = "danger";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Event - EventSpark</title>

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

    </style>

</head>

<body>

<div class="container py-5">

    <div class="mb-3">

        <a href="../dashboard.php"
           class="btn btn-dark">

            ← Dashboard

        </a>

    </div>


    <div class="card event-card shadow">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">
                Create New Event
            </h4>

        </div>


        <div class="card-body p-4">

            <?php if ($message != "") { ?>

                <div class="alert alert-<?php echo $message_type; ?>">

                    <?php
                    echo htmlspecialchars($message);
                    ?>

                </div>

            <?php } ?>


            <form method="POST"
                  enctype="multipart/form-data">


                <!-- Event Name -->

                <div class="mb-3">

                    <label class="form-label">
                        Event Title *
                    </label>

                    <input
                        type="text"
                        name="event_title"
                        class="form-control"
                        maxlength="200"
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

                        <?php while ($category = mysqli_fetch_assoc($category_result)) { ?>

                            <option
                                value="<?php echo $category['category_id']; ?>">

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
                        rows="5"></textarea>

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
                            maxlength="200">

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
                            maxlength="100">

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
                            class="form-control">

                    </div>


                    <!-- End Time -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            End Time
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            class="form-control">

                    </div>


                    <!-- Registration Deadline -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Registration Deadline
                        </label>

                        <input
                            type="date"
                            name="registration_deadline"
                            class="form-control">

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
                            min="1">

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
                            value="0">

                    </div>

                </div>


                <!-- Poster -->

                <div class="mb-4">

                    <label class="form-label">
                        Event Poster
                    </label>

                    <input
                        type="file"
                        name="poster"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Allowed formats: JPG, JPEG, PNG, WEBP
                    </small>

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    name="add_event"
                    class="btn btn-dark">

                    Create Event

                </button>

                <a
                    href="../dashboard.php"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>