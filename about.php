<?php
include("config/database.php");
include("includes/functions.php");

$totalEvents = getTotalEvents($conn);
$totalColleges = getTotalColleges($conn);
$totalCategories = getTotalCategories($conn);
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<!-- About Hero -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-primary mb-3 px-3 py-2">
                    About EventSpark
                </span>

                <h1 class="display-5 fw-bold mb-3">
                    Discover. Connect. Participate.
                </h1>

                <p class="lead text-muted">
                    EventSpark is a platform designed to help students discover
                    and participate in educational, technical, cultural, sports,
                    and other events organized by colleges.
                </p>

                <p class="text-muted">
                    Our goal is to bring students and colleges together on one
                    platform where upcoming events can be easily discovered,
                    explored, and registered for.
                </p>

                <a href="student/events.php" class="btn btn-primary px-4 mt-2">
                    <i class="bi bi-calendar-event me-2"></i>
                    Explore Events
                </a>
            </div>

            <div class="col-lg-6 text-center">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <i class="bi bi-mortarboard-fill text-primary"
                       style="font-size: 100px;"></i>

                    <h3 class="fw-bold mt-4">
                        Welcome to EventSpark
                    </h3>

                    <p class="text-muted mb-0">
                        Your platform for discovering college events.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- What is EventSpark -->
<section class="py-5">
    <div class="container py-4">

        <div class="text-center mb-5">
            <h2 class="fw-bold">What is EventSpark?</h2>
            <p class="text-muted">
                A simple platform connecting students with college events.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-search text-primary"
                           style="font-size: 45px;"></i>
                    </div>

                    <h4 class="fw-bold">Discover Events</h4>

                    <p class="text-muted">
                        Students can browse upcoming events and find
                        opportunities that match their interests.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-building text-primary"
                           style="font-size: 45px;"></i>
                    </div>

                    <h4 class="fw-bold">Explore Colleges</h4>

                    <p class="text-muted">
                        Explore events organized by different colleges
                        and institutions.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-check text-primary"
                           style="font-size: 45px;"></i>
                    </div>

                    <h4 class="fw-bold">Participate</h4>

                    <p class="text-muted">
                        Students can register for events and participate
                        in activities organized by colleges.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Our Purpose -->
<section class="py-5 bg-light">
    <div class="container py-4">

        <div class="row align-items-center">

            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-4">Our Purpose</h2>

                <p class="text-muted">
                    EventSpark is created to make event discovery easier
                    for students. Instead of searching through different
                    college websites or announcements, students can use
                    one platform to explore available events.
                </p>

                <p class="text-muted">
                    Colleges can use EventSpark to publish their events
                    and provide students with important information such
                    as event dates, venues, categories, registration
                    deadlines, and participation details.
                </p>

                <p class="text-muted mb-0">
                    EventSpark aims to provide a convenient connection
                    between students and colleges through an organized
                    event discovery platform.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="bg-white rounded-4 shadow-sm p-4">

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary text-white rounded-circle
                                    d-flex align-items-center justify-content-center me-3"
                             style="width: 55px; height: 55px;">
                            <i class="bi bi-lightbulb-fill fs-4"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Easy Discovery</h5>
                            <p class="text-muted mb-0">
                                Find events from different categories.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary text-white rounded-circle
                                    d-flex align-items-center justify-content-center me-3"
                             style="width: 55px; height: 55px;">
                            <i class="bi bi-calendar-check-fill fs-4"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Event Information</h5>
                            <p class="text-muted mb-0">
                                View important event details in one place.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle
                                    d-flex align-items-center justify-content-center me-3"
                             style="width: 55px; height: 55px;">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">Student Participation</h5>
                            <p class="text-muted mb-0">
                                Register and participate in college events.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>


<!-- EventSpark Numbers -->
<section class="py-5">
    <div class="container py-4">

        <div class="text-center mb-5">
            <h2 class="fw-bold">EventSpark at a Glance</h2>
            <p class="text-muted">
                Explore the platform and discover opportunities.
            </p>
        </div>

        <div class="row g-4 text-center">

            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100">
                    <i class="bi bi-calendar-event text-primary fs-1"></i>

                    <h2 class="fw-bold mt-3">
                        <?php echo $totalEvents; ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Events
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100">
                    <i class="bi bi-building text-primary fs-1"></i>

                    <h2 class="fw-bold mt-3">
                        <?php echo $totalColleges; ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Colleges
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 border rounded-4 h-100">
                    <i class="bi bi-grid-3x3-gap text-primary fs-1"></i>

                    <h2 class="fw-bold mt-3">
                        <?php echo $totalCategories; ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Categories
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- How EventSpark Works -->
<section class="py-5 bg-light">
    <div class="container py-4">

        <div class="text-center mb-5">
            <h2 class="fw-bold">How EventSpark Works</h2>
            <p class="text-muted">
                Discover and participate in events in a few simple steps.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle
                                mx-auto d-flex align-items-center justify-content-center"
                         style="width: 65px; height: 65px;">
                        <i class="bi bi-search fs-4"></i>
                    </div>

                    <h5 class="fw-bold mt-3">1. Explore</h5>

                    <p class="text-muted">
                        Browse upcoming college events.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle
                                mx-auto d-flex align-items-center justify-content-center"
                         style="width: 65px; height: 65px;">
                        <i class="bi bi-funnel fs-4"></i>
                    </div>

                    <h5 class="fw-bold mt-3">2. Choose</h5>

                    <p class="text-muted">
                        Find an event based on your interests.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle
                                mx-auto d-flex align-items-center justify-content-center"
                         style="width: 65px; height: 65px;">
                        <i class="bi bi-info-circle fs-4"></i>
                    </div>

                    <h5 class="fw-bold mt-3">3. View Details</h5>

                    <p class="text-muted">
                        Check the event date, venue and other details.
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle
                                mx-auto d-flex align-items-center justify-content-center"
                         style="width: 65px; height: 65px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>

                    <h5 class="fw-bold mt-3">4. Register</h5>

                    <p class="text-muted">
                        Register for the event and participate.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- Call To Action -->
<section class="py-5">
    <div class="container py-4">

        <div class="bg-primary text-white rounded-4 p-5 text-center">

            <i class="bi bi-stars fs-1"></i>

            <h2 class="fw-bold mt-3">
                Ready to Discover Your Next Event?
            </h2>

            <p class="mb-4">
                Explore upcoming events and find opportunities
                that interest you.
            </p>

            <a href="student/events.php"
               class="btn btn-light btn-lg px-4">
                <i class="bi bi-calendar-event me-2"></i>
                Explore Events
            </a>

        </div>

    </div>
</section>


<?php include("includes/footer.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>