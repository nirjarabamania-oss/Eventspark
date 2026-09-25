<?php

include("../admin_auth.php");
include("../../config/database.php");


// ==========================================
// OVERALL COUNTS
// ==========================================

$collegeResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM colleges");
$collegeData = mysqli_fetch_assoc($collegeResult);
$totalColleges = $collegeData['total'];

$studentResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$studentData = mysqli_fetch_assoc($studentResult);
$totalStudents = $studentData['total'];

$eventResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM events");
$eventData = mysqli_fetch_assoc($eventResult);
$totalEvents = $eventData['total'];

$registrationResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations");
$registrationData = mysqli_fetch_assoc($registrationResult);
$totalRegistrations = $registrationData['total'];


// ==========================================
// COLLEGES BY STATE
// ==========================================

$stateQuery = mysqli_query(
    $conn,
    "SELECT state, COUNT(*) AS total
     FROM colleges
     WHERE state IS NOT NULL
     AND state != ''
     GROUP BY state
     ORDER BY total DESC"
);


// ==========================================
// COLLEGES BY CITY
// ==========================================

$cityQuery = mysqli_query(
    $conn,
    "SELECT city, COUNT(*) AS total
     FROM colleges
     WHERE city IS NOT NULL
     AND city != ''
     GROUP BY city
     ORDER BY total DESC"
);


// ==========================================
// STUDENTS BY COLLEGE
// ==========================================

$studentCollegeQuery = mysqli_query(
    $conn,
    "SELECT
        c.college_name,
        COUNT(s.student_id) AS total
     FROM colleges c
     LEFT JOIN students s
        ON c.college_id = s.college_id
     GROUP BY c.college_id, c.college_name
     ORDER BY total DESC"
);


// ==========================================
// EVENTS BY CATEGORY
// ==========================================

$categoryQuery = mysqli_query(
    $conn,
    "SELECT
        c.category_name,
        COUNT(e.event_id) AS total
     FROM categories c
     LEFT JOIN events e
        ON c.category_id = e.category_id
     GROUP BY c.category_id, c.category_name
     ORDER BY total DESC"
);


// ==========================================
// EVENTS BY CITY
// ==========================================

$eventCityQuery = mysqli_query(
    $conn,
    "SELECT city, COUNT(*) AS total
     FROM events
     WHERE city IS NOT NULL
     AND city != ''
     GROUP BY city
     ORDER BY total DESC"
);


// ==========================================
// REGISTRATIONS BY EVENT
// ==========================================

$eventRegistrationQuery = mysqli_query(
    $conn,
    "SELECT
        e.event_title,
        COUNT(r.registration_id) AS total
     FROM events e
     LEFT JOIN registrations r
        ON e.event_id = r.event_id
     GROUP BY e.event_id, e.event_title
     ORDER BY total DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reports | EventSpark Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background-color: #f5f7fb;
        }

        .report-header {
            background: #0d6efd;
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            height: 100%;
        }

        .summary-card i {
            font-size: 35px;
            color: #0d6efd;
        }

        .summary-card h2 {
            margin-top: 10px;
            font-weight: 700;
        }

        .report-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .report-card h4 {
            margin-bottom: 20px;
            font-weight: 600;
        }

        table {
            margin-bottom: 0 !important;
        }

    </style>

</head>

<body>

<div class="container-fluid p-4">

    <!-- Header -->

    <div class="report-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2>
                    <i class="bi bi-bar-chart-fill"></i>
                    EventSpark Reports
                </h2>

                <p class="mb-0">
                    View statistics and reports of the EventSpark platform.
                </p>

            </div>

            <a href="../dashboard.php"
               class="btn btn-light">

                <i class="bi bi-arrow-left"></i>
                Dashboard

            </a>

        </div>

    </div>


    <!-- ==========================================
         SUMMARY
         ========================================== -->

    <div class="row g-4 mb-4">

        <div class="col-md-3">

            <div class="summary-card">

                <i class="bi bi-building"></i>

                <h2>
                    <?php echo $totalColleges; ?>
                </h2>

                <p class="mb-0">
                    Total Colleges
                </p>

            </div>

        </div>


        <div class="col-md-3">

            <div class="summary-card">

                <i class="bi bi-mortarboard"></i>

                <h2>
                    <?php echo $totalStudents; ?>
                </h2>

                <p class="mb-0">
                    Total Students
                </p>

            </div>

        </div>


        <div class="col-md-3">

            <div class="summary-card">

                <i class="bi bi-calendar-event"></i>

                <h2>
                    <?php echo $totalEvents; ?>
                </h2>

                <p class="mb-0">
                    Total Events
                </p>

            </div>

        </div>


        <div class="col-md-3">

            <div class="summary-card">

                <i class="bi bi-person-check"></i>

                <h2>
                    <?php echo $totalRegistrations; ?>
                </h2>

                <p class="mb-0">
                    Total Registrations
                </p>

            </div>

        </div>

    </div>


    <!-- ==========================================
         COLLEGES BY STATE
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-map"></i>
            Colleges by State / Region
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>State / Region</th>
                        <th>Total Colleges</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($stateQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($stateQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['state']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No state data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- ==========================================
         COLLEGES BY CITY
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-geo-alt"></i>
            Colleges by City
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>Total Colleges</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($cityQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($cityQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['city']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No city data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- ==========================================
         STUDENTS BY COLLEGE
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-people"></i>
            Students by College
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>College</th>
                        <th>Total Students</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($studentCollegeQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($studentCollegeQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['college_name']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No student data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- ==========================================
         EVENTS BY CATEGORY
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-tags"></i>
            Events by Category
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Total Events</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($categoryQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($categoryQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['category_name']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No category data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- ==========================================
         EVENTS BY CITY
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-geo-alt-fill"></i>
            Events by City
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>Total Events</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($eventCityQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($eventCityQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['city']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No event city data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- ==========================================
         REGISTRATIONS BY EVENT
         ========================================== -->

    <div class="report-card">

        <h4>
            <i class="bi bi-person-lines-fill"></i>
            Registrations by Event
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Total Registrations</th>
                    </tr>

                </thead>

                <tbody>

                <?php

                $count = 1;

                if (mysqli_num_rows($eventRegistrationQuery) > 0) {

                    while ($row = mysqli_fetch_assoc($eventRegistrationQuery)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $count++; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['event_title']); ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['total']; ?>
                            </strong>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="3"
                            class="text-center">

                            No registration data available.

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>