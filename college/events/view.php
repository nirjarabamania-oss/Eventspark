<?php
include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

/*
    Fetch only events created by the logged-in college.
    Category name is taken from the categories table.
*/
$sql = "SELECT
            e.event_id,
            e.event_title,
            e.description,
            e.venue,
            e.city,
            e.event_date,
            e.start_time,
            e.end_time,
            e.registration_deadline,
            e.max_participants,
            e.registration_fee,
            e.poster,
            e.status,
            e.created_at,
            c.category_name
        FROM events e
        LEFT JOIN categories c
            ON e.category_id = c.category_id
        WHERE e.college_id = ?
        ORDER BY e.event_date DESC";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $college_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Events - EventSpark</title>

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
            overflow: hidden;
        }

        .event-poster {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .no-poster {
            width: 100%;
            height: 200px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .event-title {
            font-weight: 600;
        }

        .badge-open {
            background-color: #198754;
        }

        .badge-closed {
            background-color: #dc3545;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- Top buttons -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                My Events
            </h2>

            <p class="text-muted mb-0">
                Manage events created by your college.
            </p>

        </div>

        <div>

            <a
                href="add.php"
                class="btn btn-dark">

                + Add Event

            </a>

            <a
                href="../dashboard.php"
                class="btn btn-secondary">

                Dashboard

            </a>

        </div>

    </div>


    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="row g-4">

            <?php while ($event = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card event-card shadow-sm h-100">

                        <!-- Poster -->

                        <?php if (!empty($event['poster'])) { ?>

                            <img
                                src="../../assets/uploads/events/<?php echo htmlspecialchars($event['poster']); ?>"
                                class="event-poster"
                                alt="Event Poster">

                        <?php } else { ?>

                            <div class="no-poster">

                                No Poster Available

                            </div>

                        <?php } ?>


                        <div class="card-body">

                            <!-- Event Title -->

                            <h5 class="event-title">

                                <?php
                                echo htmlspecialchars(
                                    $event['event_title']
                                );
                                ?>

                            </h5>


                            <!-- Category -->

                            <p class="mb-2">

                                <strong>Category:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $event['category_name'] ?? 'Not specified'
                                );
                                ?>

                            </p>


                            <!-- Venue -->

                            <p class="mb-2">

                                <strong>Venue:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $event['venue'] ?? 'Not specified'
                                );
                                ?>

                            </p>


                            <!-- City -->

                            <p class="mb-2">

                                <strong>City:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $event['city'] ?? 'Not specified'
                                );
                                ?>

                            </p>


                            <!-- Date -->

                            <p class="mb-2">

                                <strong>Date:</strong>

                                <?php
                                echo date(
                                    "d M Y",
                                    strtotime($event['event_date'])
                                );
                                ?>

                            </p>


                            <!-- Time -->

                            <?php if (
                                !empty($event['start_time']) ||
                                !empty($event['end_time'])
                            ) { ?>

                                <p class="mb-2">

                                    <strong>Time:</strong>

                                    <?php if (!empty($event['start_time'])) { ?>

                                        <?php
                                        echo date(
                                            "h:i A",
                                            strtotime($event['start_time'])
                                        );
                                        ?>

                                    <?php } ?>

                                    <?php if (
                                        !empty($event['start_time']) &&
                                        !empty($event['end_time'])
                                    ) { ?>

                                        -
                                        
                                    <?php } ?>

                                    <?php if (!empty($event['end_time'])) { ?>

                                        <?php
                                        echo date(
                                            "h:i A",
                                            strtotime($event['end_time'])
                                        );
                                        ?>

                                    <?php } ?>

                                </p>

                            <?php } ?>


                            <!-- Registration Deadline -->

                            <?php if (
                                !empty($event['registration_deadline'])
                            ) { ?>

                                <p class="mb-2">

                                    <strong>Registration Deadline:</strong>

                                    <?php
                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $event['registration_deadline']
                                        )
                                    );
                                    ?>

                                </p>

                            <?php } ?>


                            <!-- Participants -->

                            <?php if (
                                !empty($event['max_participants'])
                            ) { ?>

                                <p class="mb-2">

                                    <strong>Max Participants:</strong>

                                    <?php
                                    echo htmlspecialchars(
                                        $event['max_participants']
                                    );
                                    ?>

                                </p>

                            <?php } ?>


                            <!-- Registration Fee -->

                            <p class="mb-2">

                                <strong>Registration Fee:</strong>

                                ₹<?php
                                echo number_format(
                                    (float)$event['registration_fee'],
                                    2
                                );
                                ?>

                            </p>


                            <!-- Status -->

                            <p class="mb-3">

                                <strong>Status:</strong>

                                <?php if ($event['status'] === 'Open') { ?>

                                    <span class="badge badge-open">
                                        Open
                                    </span>

                                <?php } else { ?>

                                    <span class="badge badge-closed">
                                        Closed
                                    </span>

                                <?php } ?>

                            </p>


                            <!-- Buttons -->

                            <div class="d-flex gap-2">

                                <a
                                    href="edit.php?id=<?php echo $event['event_id']; ?>"
                                    class="btn btn-primary btn-sm">

                                    Edit

                                </a>

                                <a
                                    href="delete.php?id=<?php echo $event['event_id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this event?');">

                                    Delete

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="card shadow-sm">

            <div class="card-body text-center py-5">

                <h5>
                    No Events Found
                </h5>

                <p class="text-muted">
                    Your college has not created any events yet.
                </p>

                <a
                    href="add.php"
                    class="btn btn-dark">

                    Create Your First Event

                </a>

            </div>

        </div>

    <?php } ?>

</div>

</body>

</html>

<?php
mysqli_stmt_close($stmt);
?>