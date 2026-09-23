<?php

include("../admin_auth.php");
include("../../config/database.php");

// Fetch all events with college and category names
$query = "SELECT 
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
            c.college_name,
            cat.category_name
          FROM events e
          LEFT JOIN colleges c
            ON e.college_id = c.college_id
          LEFT JOIN categories cat
            ON e.category_id = cat.category_id
          ORDER BY e.event_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching events: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Events - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Manage Events</h2>

        <a href="../dashboard.php" class="btn btn-dark">
            Back to Dashboard
        </a>

    </div>


    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Event Title</th>
                        <th>College</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>City</th>
                        <th>Event Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Deadline</th>
                        <th>Max Participants</th>
                        <th>Fee</th>
                        <th>Poster</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php while ($event = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $event['event_id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['event_title']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['college_name'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['category_name'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['venue']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['city']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['event_date']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['start_time']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['end_time']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['registration_deadline'] ?? ''); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['max_participants']); ?>
                        </td>

                        <td>
                            ₹<?php echo htmlspecialchars($event['registration_fee']); ?>
                        </td>

                        <td>

                            <?php if (!empty($event['poster'])) { ?>

                                <img
                                    src="../../assets/uploads/events/<?php echo htmlspecialchars($event['poster']); ?>"
                                    width="70"
                                    height="70"
                                    style="object-fit: cover;"
                                    alt="Event Poster"
                                >

                            <?php } else { ?>

                                No Poster

                            <?php } ?>

                        </td>

                        <td>

                            <?php if ($event['status'] == 'Open') { ?>

                                <span class="badge bg-success">
                                    Open
                                </span>

                            <?php } else { ?>

                                <span class="badge bg-secondary">
                                    Closed
                                </span>

                            <?php } ?>

                        </td>

                        <td>
                            <?php echo htmlspecialchars($event['created_at']); ?>
                        </td>

                        <td>

                            <a
                                href="delete.php?id=<?php echo $event['event_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to permanently delete this event?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } else { ?>

        <div class="alert alert-info">
            No events available.
        </div>

    <?php } ?>

</div>

</body>
</html>