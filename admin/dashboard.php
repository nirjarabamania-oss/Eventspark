 <?php

include("admin_auth.php");
include("../config/database.php");

/*
|--------------------------------------------------------------------------
| Get Counts
|--------------------------------------------------------------------------
*/

$collegeQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM colleges");
$collegeCount = mysqli_fetch_assoc($collegeQuery)['total'];

$studentQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$studentCount = mysqli_fetch_assoc($studentQuery)['total'];

$eventQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM events");
$eventCount = mysqli_fetch_assoc($eventQuery)['total'];

$categoryQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories");
$categoryCount = mysqli_fetch_assoc($categoryQuery)['total'];

$registrationQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations");
$registrationCount = mysqli_fetch_assoc($registrationQuery)['total'];

/*
|--------------------------------------------------------------------------
| Admin Name
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['username'] ?? 'Admin';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <span class="navbar-brand mb-0 h1">
            EventSpark Admin Panel
        </span>

        <div class="d-flex align-items-center">

            <span class="text-white me-3">
                Welcome, <?php echo htmlspecialchars($adminName); ?>
            </span>

            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>

        </div>

    </div>

</nav>


<!-- Dashboard -->

<div class="container-fluid mt-4">

    <div class="mb-4">

        <h2>Admin Dashboard</h2>

        <p class="text-muted">
            Manage EventSpark from the Admin Panel.
        </p>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-5">


        <!-- Colleges -->

        <div class="col-md-4 col-lg-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="card-title">
                        Colleges
                    </h5>

                    <h2 class="fw-bold">
                        <?php echo $collegeCount; ?>
                    </h2>

                    <p class="text-muted">
                        Total registered colleges
                    </p>

                    <a
                        href="colleges/view.php"
                        class="btn btn-dark w-100"
                    >
                        Manage Colleges
                    </a>

                </div>

            </div>

        </div>


        <!-- Students -->

        <div class="col-md-4 col-lg-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="card-title">
                        Students
                    </h5>

                    <h2 class="fw-bold">
                        <?php echo $studentCount; ?>
                    </h2>

                    <p class="text-muted">
                        Registered students
                    </p>

                    <a
                        href="students/view.php"
                        class="btn btn-dark w-100"
                    >
                        Manage Students
                    </a>

                </div>

            </div>

        </div>


        <!-- Events -->

        <div class="col-md-4 col-lg-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="card-title">
                        Events
                    </h5>

                    <h2 class="fw-bold">
                        <?php echo $eventCount; ?>
                    </h2>

                    <p class="text-muted">
                        Total events
                    </p>

                    <a
                        href="events/view.php"
                        class="btn btn-dark w-100"
                    >
                        Manage Events
                    </a>

                </div>

            </div>

        </div>


        <!-- Categories -->

        <div class="col-md-4 col-lg-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="card-title">
                        Categories
                    </h5>

                    <h2 class="fw-bold">
                        <?php echo $categoryCount; ?>
                    </h2>

                    <p class="text-muted">
                        Event categories
                    </p>

                    <a
                        href="categories/view.php"
                        class="btn btn-primary w-100"
                    >
                        Manage Categories
                    </a>

                </div>

            </div>

        </div>


        <!-- Registrations -->

        <div class="col-md-4 col-lg-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5 class="card-title">
                        Registrations
                    </h5>

                    <h2 class="fw-bold">
                        <?php echo $registrationCount; ?>
                    </h2>

                    <p class="text-muted">
                        Student event registrations
                    </p>

                    <a
                        href="registrations/view.php"
                        class="btn btn-info w-100"
                    >
                        View Registrations
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Management Section -->

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">
                Management
            </h4>

        </div>

        <div class="card-body">

            <div class="row g-3">


                <!-- Colleges -->

                <div class="col-md-4">

                    <a
                        href="colleges/view.php"
                        class="btn btn-outline-dark w-100 py-3"
                    >
                        Manage Colleges
                    </a>

                </div>


                <!-- Students -->

                <div class="col-md-4">

                    <a
                        href="students/view.php"
                        class="btn btn-outline-dark w-100 py-3"
                    >
                        Manage Students
                    </a>

                </div>


                <!-- Events -->

                <div class="col-md-4">

                    <a
                        href="events/view.php"
                        class="btn btn-outline-dark w-100 py-3"
                    >
                        Manage Events
                    </a>

                </div>


                <!-- Categories -->

                <div class="col-md-4">

                    <a
                        href="categories/view.php"
                        class="btn btn-outline-primary w-100 py-3"
                    >
                        Manage Categories
                    </a>

                </div>


                <!-- Registrations -->

                <div class="col-md-4">

                    <a
                        href="registrations/view.php"
                        class="btn btn-outline-info w-100 py-3"
                    >
                        View Registrations
                    </a>

                </div>


            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>