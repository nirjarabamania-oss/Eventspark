<?php
include("config/database.php");
include("includes/functions.php");
$totalEvents = getTotalEvents($conn);
$totalColleges = getTotalColleges($conn);
$totalCategories = getTotalCategories($conn);
$categories = getCategories($conn);
$upcomingEvents = getUpcomingEvents($conn);
$colleges = getFeaturedColleges($conn);

?>

<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>


<!-- ================= HERO SECTION ================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1>
                    Discover Study Events
                    <span>That Shape Your Future</span>
                </h1>

                <p>

                    Explore workshops, seminars, hackathons,
                    coding contests, webinars and conferences
                    based on your interests and academic goals.

                </p>

                <div class="mt-4">

                    <a href="#" class="btn btn-primary btn-lg me-3">
                        Explore Events
                    </a>

                    <a href="#" class="btn btn-outline-light btn-lg">
                        Find Colleges
                    </a>

                </div>

                <div class="stats-box">

                    <div class="stat">

                        <h3><?php echo $totalEvents; ?>+</h3>
                        <p>Events</p>

                    </div>

                    <div class="stat">

                        <h3><?php echo $totalEvents; ?>+</h3>
                        <p>Colleges</p>

                    </div>

                    <div class="stat">

                        <h3>><?php echo $totalCategories; ?>+</h3>
                        <p>Study Areas</p>

                    </div>

                </div>

            </div>

            <div class="col-lg-6 text-center">

                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=900"
                    class="img-fluid rounded-4 hero-image">

            </div>

        </div>

    </div>

</section>

<!-- ================= SEARCH SECTION ================= -->

<section class="search-section py-5">

    <div class="container">

        <div class="search-box shadow">

            <form action="events.php" method="GET">

                <div class="row g-3">

                    <!-- Search by event title -->

                    <div class="col-lg-4">

                        <input type="text"
                               name="search"
                               class="form-control form-control-lg"
                               placeholder="Search Events">

                    </div>


                    <!-- Category -->

                    <div class="col-lg-3">

                        <select name="category"
                                class="form-select form-select-lg">

                            <option value="">
                                Select Category
                            </option>

                            <?php foreach ($categories as $category): ?>

                                <option value="<?php echo htmlspecialchars($category['category_id']); ?>">

                                    <?php echo htmlspecialchars($category['category_name']); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- City -->

                    <div class="col-lg-3">

                        <input type="text"
                               name="city"
                               class="form-control form-control-lg"
                               placeholder="Enter City">

                    </div>


                    <!-- Search button -->

                    <div class="col-lg-2 d-grid">

                        <button type="submit"
                                class="btn btn-primary btn-lg">

                            <i class="bi bi-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

<!-- ================= CATEGORIES ================= -->

<section class="categories py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Explore by Study Interest
            </h2>

            <p class="text-muted">
                Find events related to your academic field.
            </p>

        </div>

        <div class="row g-4">

            <?php foreach ($categories as $category): ?>

                <div class="col-lg-3 col-md-6">

                    <div class="category-card">

                        <i class="bi bi-calendar-event"></i>

                        <h4>
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </h4>

                        <p>
                            Explore
                            <?php echo htmlspecialchars($category['category_name']); ?>
                            events.
                        </p>

                        <a href="events.php?category=<?php echo urlencode($category['category_id']); ?>"
                           class="stretched-link">
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- ================= UPCOMING EVENTS ================= -->

<section class="events py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">Upcoming Study Events</h2>

            <p class="text-muted">
                Discover academic events from colleges and universities.
            </p>

        </div>

       <div class="row g-4">

    <?php if (!empty($upcomingEvents)): ?>

        <?php foreach ($upcomingEvents as $event): ?>

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <?php if (!empty($event['poster'])): ?>

                        <img src="uploads/event_posters/<?php echo htmlspecialchars($event['poster']); ?>"
                             class="card-img-top"
                             alt="<?php echo htmlspecialchars($event['event_title']); ?>">

                    <?php else: ?>

                        <div class="event-placeholder">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                    <?php endif; ?>


                    <div class="card-body">

                        <span class="badge bg-primary mb-2">
                            <?php echo htmlspecialchars($event['category_name']); ?>
                        </span>

                        <h5 class="card-title">
                            <?php echo htmlspecialchars($event['event_title']); ?>
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            <?php echo date("d F Y", strtotime($event['event_date'])); ?>
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            <?php echo htmlspecialchars($event['venue']); ?>,
                            <?php echo htmlspecialchars($event['city']); ?>
                        </p>

                        <?php if (!empty($event['registration_deadline'])): ?>

                            <p class="text-muted">
                                <i class="bi bi-clock"></i>
                                Registration closes on
                                <?php echo date("d F", strtotime($event['registration_deadline'])); ?>
                            </p>

                        <?php endif; ?>

                        <a href="student/event_details.php?id=<?php echo $event['event_id']; ?>"
                           class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="col-12">

            <div class="text-center py-5">

                <i class="bi bi-calendar-x fs-1 text-muted"></i>

                <h5 class="mt-3">No Upcoming Events</h5>

                <p class="text-muted">
                    There are currently no upcoming events available.
                </p>

            </div>

        </div>

    <?php endif; ?>

</div>

    </div>

</section>
<!-- ================= TOP COLLEGES ================= -->

<section class="colleges py-5">

    <div class="container">

        <div class="row g-4">

            <?php if (!empty($colleges)): ?>

        <?php foreach ($colleges as $college): ?>

            <div class="col-lg-4 col-md-6">

                <div class="card college-card h-100">

                    <?php if (!empty($college['logo'])): ?>

                        <img src="uploads/college_logos/<?php echo htmlspecialchars($college['logo']); ?>"
                             class="card-img-top"
                             alt="<?php echo htmlspecialchars($college['college_name']); ?>">

                    <?php else: ?>

                        <div class="college-placeholder">
                            <i class="bi bi-building"></i>
                        </div>

                    <?php endif; ?>

                    <div class="card-body">

                        <h5 class="card-title">
                            <?php echo htmlspecialchars($college['college_name']); ?>
                        </h5>

                        <?php if (!empty($college['university'])): ?>
                            <p class="text-muted mb-1">
                                <?php echo htmlspecialchars($college['university']); ?>
                            </p>
                        <?php endif; ?>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            <?php echo htmlspecialchars($college['city']); ?>,
                            <?php echo htmlspecialchars($college['state']); ?>
                        </p>

                        <a href="colleges.php?id=<?php echo $college['college_id']; ?>"
                           class="btn btn-primary w-100">
                            View College
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="col-12 text-center">
            <p class="text-muted">
                No colleges are currently available.
            </p>
        </div>

    <?php endif; ?>

</div>

    </div>

</section>

<!-- ================= WHY CHOOSE ================= -->

<section class="why py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose EventSpark?</h2>
        </div>

        <div class="row g-4">

            <div class="col-lg-3">
                <div class="feature-box">
                    <i class="bi bi-search"></i>
                    <h4>Smart Search</h4>
                    <p>Find study events according to your interests.</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="feature-box">
                    <i class="bi bi-patch-check-fill"></i>
                    <h4>Verified Colleges</h4>
                    <p>Only trusted colleges can publish events.</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="feature-box">
                    <i class="bi bi-link-45deg"></i>
                    <h4>Official Registration</h4>
                    <p>Register directly through the college website.</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="feature-box">
                    <i class="bi bi-lightbulb-fill"></i>
                    <h4>Career Growth</h4>
                    <p>Improve your skills through academic events.</p>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- ================= HOW IT WORKS ================= -->

<section class="how py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">How It Works</h2>

        </div>

        <div class="row text-center">

            <div class="col-lg-4">

                <div class="step-box">

                    <div class="step-number">
                        1
                    </div>

                    <h4>Browse Events</h4>

                    <p>
                        Search academic events based on your study area.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="step-box">

                    <div class="step-number">
                        2
                    </div>

                    <h4>View Details</h4>

                    <p>
                        Check venue, date, eligibility and event information.
                    </p>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="step-box">

                    <div class="step-number">
                        3
                    </div>

                    <h4>Register</h4>

                    <p>
                        Continue to the official college registration page.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
