<?php

include("../admin_auth.php");
include("../../config/database.php");

$query = "SELECT
            r.registration_id,
            r.registration_date,
            r.status,

            s.full_name AS student_name,
            s.email AS student_email,

            student_college.college_name AS student_college,

            e.event_title,

            event_college.college_name AS event_college

          FROM registrations r

          INNER JOIN students s
            ON r.student_id = s.student_id

          INNER JOIN colleges student_college
            ON s.college_id = student_college.college_id

          INNER JOIN events e
            ON r.event_id = e.event_id

          INNER JOIN colleges event_college
            ON e.college_id = event_college.college_id

          ORDER BY r.registration_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching registrations: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrations - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Event Registrations</h2>

        <a href="../dashboard.php" class="btn btn-dark">
            Back to Dashboard
        </a>

    </div>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Registration ID</th>
                        <th>Student Name</th>
                        <th>Student Email</th>
                        <th>Student College</th>
                        <th>Event</th>
                        <th>Event College</th>
                        <th>Registration Date</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php while ($registration = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $registration['registration_id']; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['student_name']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['student_email']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['student_college']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['event_title']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['event_college']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['registration_date']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $registration['status']
                            );
                            ?>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    <?php } else { ?>

        <div class="alert alert-info">
            No registrations found.
        </div>

    <?php } ?>

</div>

</body>

</html>