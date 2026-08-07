<?php
include("admin_auth.php");
include("../includes/header.php");
?>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white min-vh-100 p-3">
            <h3 class="text-center">EventSpark</h3>
            <hr>

            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="dashboard.php" class="nav-link text-white">🏠 Dashboard</a>
                </li>

                <li class="nav-item mb-2">
                    <a href="colleges/view.php" class="nav-link text-white">🏫 Colleges</a>
                </li>

                <li class="nav-item mb-2">
                    <a href="events/view.php" class="nav-link text-white">🎉 Events</a>
                </li>

                <li class="nav-item mb-2">
                    <a href="students/view.php" class="nav-link text-white">👨‍🎓 Students</a>
                </li>

                <li class="nav-item mb-2">
                    <a href="registrations/view.php" class="nav-link text-white">📝 Registrations</a>
                </li>

                <li class="nav-item mt-4">
                    <a href="logout.php" class="nav-link text-danger">🚪 Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">

            <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
            <p class="text-muted">EventSpark Administration Panel</p>

            <div class="row mt-4">

                <div class="col-md-3 mb-4">
                    <div class="card border-primary shadow">
                        <div class="card-body text-center">
                            <h5>Total Colleges</h5>
                            <h2>--</h2>
                            <a href="colleges/view.php" class="btn btn-primary btn-sm">Manage</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-success shadow">
                        <div class="card-body text-center">
                            <h5>Total Events</h5>
                            <h2>--</h2>
                            <a href="events/view.php" class="btn btn-success btn-sm">Manage</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-warning shadow">
                        <div class="card-body text-center">
                            <h5>Total Students</h5>
                            <h2>--</h2>
                            <a href="students/view.php" class="btn btn-warning btn-sm">Manage</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-danger shadow">
                        <div class="card-body text-center">
                            <h5>Registrations</h5>
                            <h2>--</h2>
                            <a href="registrations/view.php" class="btn btn-danger btn-sm">Manage</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card shadow mt-3">
                <div class="card-header bg-dark text-white">
                    Admin Panel
                </div>
                <div class="card-body">
                    <p>Welcome to the EventSpark Admin Dashboard.</p>

                    <p>
                        From here you will be able to:
                    </p>

                    <ul>
                        <li>Manage Colleges</li>
                        <li>Manage Events</li>
                        <li>Manage Students</li>
                        <li>View Event Registrations</li>
                    </ul>

                    <p class="text-muted">
                        Statistics will automatically appear here once data is added to the system.
                    </p>

                </div>
            </div>

        </div>

    </div>
</div>

<?php
include("../includes/footer.php");
?>