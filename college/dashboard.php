<?php
include("college_auth.php");
include("../config/database.php");

// Get logged-in college ID
$college_id = $_SESSION['college_id'];

// Get college information
$sql = "SELECT * FROM colleges WHERE college_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $college_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$college = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

// Count events created by this college
$event_count = 0;

$event_sql = "SELECT COUNT(*) AS total FROM events WHERE college_id = ?";

$event_stmt = mysqli_prepare($conn, $event_sql);
mysqli_stmt_bind_param($event_stmt, "i", $college_id);
mysqli_stmt_execute($event_stmt);

$event_result = mysqli_stmt_get_result($event_stmt);
$event_data = mysqli_fetch_assoc($event_result);

$event_count = $event_data['total'];

mysqli_stmt_close($event_stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>College Dashboard - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #343a40;
        }

        .college-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid white;
        }

        .dashboard-card {
            border: none;
            border-radius: 12px;
        }

    </style>

</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->

        <div class="col-md-2 sidebar text-white p-3">

            <div class="text-center mb-4">

                <?php if (!empty($college['logo'])) { ?>

                    <img
                        src="../assets/uploads/colleges/logos/<?php echo htmlspecialchars($college['logo']); ?>"
                        class="college-logo"
                        alt="College Logo">

                <?php } else { ?>

                    <div class="college-logo bg-secondary
                                d-flex align-items-center
                                justify-content-center mx-auto">

                        <span>No Logo</span>

                    </div>

                <?php } ?>

                <h5 class="mt-3">
                    <?php echo htmlspecialchars($college['college_name']); ?>
                </h5>

            </div>

            <hr>

            <a href="dashboard.php">
                🏠 Dashboard
            </a>

            <a href="profile.php">
                👤 My Profile
            </a>

            <a href="events/view.php">
                🎉 My Events
            </a>

            <a href="events/add.php">
                ➕ Add Event
            </a>

            <a href="registrations/view.php">
                📝 Registrations
            </a>

            <a href="logout.php"
               class="text-danger mt-4">

                🚪 Logout

            </a>

        </div>


        <!-- Main Content -->

        <div class="col-md-10 p-4">

            <!-- Header -->

            <div class="d-flex
                        justify-content-between
                        align-items-center
                        mb-4">

                <div>

                    <h2>
                        Welcome,
                        <?php echo htmlspecialchars($college['college_name']); ?>
                        👋
                    </h2>

                    <p class="text-muted mb-0">
                        College Administration Dashboard
                    </p>

                </div>

            </div>


            <!-- Statistics -->

            <div class="row">

                <div class="col-md-4 mb-4">

                    <div class="card dashboard-card shadow-sm">

                        <div class="card-body">

                            <h6 class="text-muted">
                                My Events
                            </h6>

                            <h2>
                                <?php echo $event_count; ?>
                            </h2>

                            <a href="events/view.php"
                               class="btn btn-dark btn-sm">

                                View Events

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <div class="card dashboard-card shadow-sm">

                        <div class="card-body">

                            <h6 class="text-muted">
                                College Status
                            </h6>

                            <h4 class="mt-2">

                                <?php
                                if ($college['status'] === 'Approved') {
                                    echo '<span class="badge bg-success">Approved</span>';
                                } elseif ($college['status'] === 'Pending') {
                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                } else {
                                    echo '<span class="badge bg-danger">Rejected</span>';
                                }
                                ?>

                            </h4>

                        </div>

                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <div class="card dashboard-card shadow-sm">

                        <div class="card-body">

                            <h6 class="text-muted">
                                University
                            </h6>

                            <h5 class="mt-2">

                                <?php
                                echo htmlspecialchars(
                                    $college['university'] ?? 'Not provided'
                                );
                                ?>

                            </h5>

                        </div>

                    </div>

                </div>

            </div>


            <!-- College Information -->

            <div class="card shadow-sm border-0 mt-2">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">
                        College Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <strong>College Name:</strong><br>

                            <?php
                            echo htmlspecialchars(
                                $college['college_name']
                            );
                            ?>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Email:</strong><br>

                            <?php
                            echo htmlspecialchars(
                                $college['email']
                            );
                            ?>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Phone:</strong><br>

                            <?php
                            echo htmlspecialchars(
                                $college['phone'] ?? 'Not provided'
                            );
                            ?>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Location:</strong><br>

                            <?php
                            echo htmlspecialchars(
                                ($college['city'] ?? '') .
                                ', ' .
                                ($college['state'] ?? '')
                            );
                            ?>

                        </div>

                    </div>


                    <a href="profile.php"
                       class="btn btn-outline-dark">

                        Manage Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>