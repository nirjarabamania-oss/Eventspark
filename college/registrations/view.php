<?php

include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

/*
    Get registrations for events belonging
    to the currently logged-in college.
*/

$sql = "SELECT
            r.registration_id,
            r.event_id,
            r.student_id,
            r.registration_date,
            r.status,
            e.event_title
        FROM registrations r
        INNER JOIN events e
            ON r.event_id = e.event_id
        WHERE e.college_id = ?
        ORDER BY r.registration_date DESC";

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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Event Registrations - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .table th {
            white-space: nowrap;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Event Registrations
            </h2>

            <p class="text-muted mb-0">
                View students registered for your college events.
            </p>

        </div>

        <a
            href="../dashboard.php"
            class="btn btn-secondary">

            Dashboard

        </a>

    </div>


    <!-- Registration List -->

    <div class="card shadow-sm">

        <div class="card-body">

            <?php if (mysqli_num_rows($result) > 0) { ?>

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Event
                                </th>

                                <th>
                                    Student ID
                                </th>

                                <th>
                                    Registration Date
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $count = 1;

                            while (
                                $registration =
                                mysqli_fetch_assoc($result)
                            ) {
                            ?>

                                <tr>

                                    <!-- Serial Number -->

                                    <td>
                                        <?php echo $count++; ?>
                                    </td>


                                    <!-- Event -->

                                    <td>

                                        <strong>
                                            <?php
                                            echo htmlspecialchars(
                                                $registration['event_title']
                                            );
                                            ?>
                                        </strong>

                                    </td>


                                    <!-- Student ID -->

                                    <td>

                                        <?php
                                        echo htmlspecialchars(
                                            $registration['student_id']
                                        );
                                        ?>

                                    </td>


                                    <!-- Registration Date -->

                                    <td>

                                        <?php

                                        if (
                                            !empty(
                                                $registration[
                                                    'registration_date'
                                                ]
                                            )
                                        ) {

                                            echo date(
                                                "d M Y, h:i A",
                                                strtotime(
                                                    $registration[
                                                        'registration_date'
                                                    ]
                                                )
                                            );

                                        } else {

                                            echo "N/A";

                                        }

                                        ?>

                                    </td>


                                    <!-- Status -->

                                    <td>

                                        <?php
                                        $status =
                                            $registration['status'];
                                        ?>

                                        <?php if (
                                            $status === 'Registered'
                                        ) { ?>

                                            <span
                                                class="badge bg-success">

                                                Registered

                                            </span>

                                        <?php } else { ?>

                                            <span
                                                class="badge bg-secondary">

                                                <?php
                                                echo htmlspecialchars(
                                                    $status
                                                );
                                                ?>

                                            </span>

                                        <?php } ?>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } else { ?>

                <div class="text-center py-5">

                    <h5>
                        No Registrations Found
                    </h5>

                    <p class="text-muted">
                        No students have registered for your events yet.
                    </p>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);

?>