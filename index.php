<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EventSpark | Discover Study Events</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <a class="navbar-brand fw-bold fs-3 text-primary" href="#">
            <i class="bi bi-mortarboard-fill"></i>
            EventSpark
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Events</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Study Areas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Colleges</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

            </ul>

            <a href="login.php" class="btn btn-outline-primary me-2">
                Login
            </a>

            <a href="register.php" class="btn btn-primary">
                Register
            </a>

        </div>

    </div>

</nav>

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

                        <h3>500+</h3>
                        <p>Events</p>

                    </div>

                    <div class="stat">

                        <h3>100+</h3>
                        <p>Colleges</p>

                    </div>

                    <div class="stat">

                        <h3>50+</h3>
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

            <div class="row g-3">

                <div class="col-lg-4">

                    <input type="text"
                           class="form-control form-control-lg"
                           placeholder="Search Events">

                </div>

                <div class="col-lg-3">

                    <select class="form-select form-select-lg">

                        <option>Select Study Area</option>
                        <option>Computer Science</option>
                        <option>Artificial Intelligence</option>
                        <option>Engineering</option>
                        <option>Commerce</option>
                        <option>Management</option>
                        <option>Medical</option>

                    </select>

                </div>

                <div class="col-lg-3">

                    <input type="text"
                           class="form-control form-control-lg"
                           placeholder="Enter City">

                </div>

                <div class="col-lg-2 d-grid">

                    <button class="btn btn-primary btn-lg">

                        <i class="bi bi-search"></i>

                        Search

                    </button>

                </div>

            </div>

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

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-laptop"></i>

                    <h4>Computer Science</h4>

                    <p>Hackathons, coding contests and workshops.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-cpu"></i>

                    <h4>Artificial Intelligence</h4>

                    <p>AI seminars and machine learning events.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-gear-fill"></i>

                    <h4>Engineering</h4>

                    <p>Technical exhibitions and innovation fairs.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-graph-up-arrow"></i>

                    <h4>Management</h4>

                    <p>Leadership and business workshops.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-bank"></i>

                    <h4>Commerce</h4>

                    <p>Finance, accounting and entrepreneurship.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-heart-pulse-fill"></i>

                    <h4>Medical</h4>

                    <p>Medical conferences and healthcare seminars.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-shield-lock-fill"></i>

                    <h4>Cyber Security</h4>

                    <p>Ethical hacking and cyber awareness events.</p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="category-card">

                    <i class="bi bi-bar-chart-fill"></i>

                    <h4>Data Science</h4>

                    <p>Analytics, Python and big data workshops.</p>

                </div>

            </div>

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

            <!-- Event 1 -->
            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-primary mb-2">Workshop</span>

                        <h5 class="card-title">
                            AI & Machine Learning Workshop
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            15 August 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            PDEU, Gandhinagar
                        </p>

                        <p class="text-muted">
                            Registration closes on 10 August
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

            <!-- Event 2 -->

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-success mb-2">
                            Seminar
                        </span>

                        <h5>
                            Career Guidance Seminar
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            20 August 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            CHARUSAT University
                        </p>

                        <p class="text-muted">
                            Registration closes on 18 August
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

            <!-- Event 3 -->

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-danger mb-2">
                            Hackathon
                        </span>

                        <h5>
                            National Coding Challenge
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            5 September 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            IIT Bombay
                        </p>

                        <p class="text-muted">
                            Registration closes on 30 August
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

            <!-- Event 4 -->

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-warning text-dark mb-2">
                            Webinar
                        </span>

                        <h5>
                            Future of Cyber Security
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            25 August 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            Online
                        </p>

                        <p class="text-muted">
                            Registration closes on 23 August
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

            <!-- Event 5 -->

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-info mb-2">
                            Conference
                        </span>

                        <h5>
                            National Research Conference
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            18 September 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            NIT Trichy
                        </p>

                        <p class="text-muted">
                            Registration closes on 12 September
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

            <!-- Event 6 -->

            <div class="col-lg-4 col-md-6">

                <div class="card event-card h-100">

                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800"
                         class="card-img-top">

                    <div class="card-body">

                        <span class="badge bg-secondary mb-2">
                            Workshop
                        </span>

                        <h5>
                            UI/UX Design Bootcamp
                        </h5>

                        <p class="text-muted">
                            <i class="bi bi-calendar"></i>
                            30 August 2026
                        </p>

                        <p class="text-muted">
                            <i class="bi bi-geo-alt"></i>
                            DAIICT
                        </p>

                        <p class="text-muted">
                            Registration closes on 25 August
                        </p>

                        <a href="#" class="btn btn-primary w-100">
                            View Details
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ================= TOP COLLEGES ================= -->

<section class="colleges py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Top Colleges Hosting Events</h2>
            <p class="text-muted">
                Discover academic events organized by leading institutions.
            </p>
        </div>

        <div class="row g-4">

            <!-- College 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="college-card">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=700"
                        class="img-fluid">

                    <div class="p-4">
                        <h5>IIT Bombay</h5>
                        <p>Mumbai, Maharashtra</p>
                        <span class="badge bg-primary">18 Events</span>

                        <a href="#" class="btn btn-outline-primary w-100 mt-3">
                            View Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- College 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="college-card">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=700"
                        class="img-fluid">

                    <div class="p-4">
                        <h5>PDEU</h5>
                        <p>Gandhinagar</p>
                        <span class="badge bg-success">12 Events</span>

                        <a href="#" class="btn btn-outline-primary w-100 mt-3">
                            View Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- College 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="college-card">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=700"
                        class="img-fluid">

                    <div class="p-4">
                        <h5>DAIICT</h5>
                        <p>Gandhinagar</p>
                        <span class="badge bg-warning text-dark">10 Events</span>

                        <a href="#" class="btn btn-outline-primary w-100 mt-3">
                            View Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- College 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="college-card">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=700"
                        class="img-fluid">

                    <div class="p-4">
                        <h5>CHARUSAT</h5>
                        <p>Anand</p>
                        <span class="badge bg-danger">15 Events</span>

                        <a href="#" class="btn btn-outline-primary w-100 mt-3">
                            View Events
                        </a>
                    </div>
                </div>
            </div>

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
<!-- ================= TESTIMONIALS ================= -->

<section class="testimonials py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">What Students Say</h2>
            <p class="text-muted">
                Students who discovered opportunities through EventSpark.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-4">
                <div class="testimonial-card">

                    <img src="https://randomuser.me/api/portraits/men/32.jpg">

                    <h5>Rahul Patel</h5>

                    <small>B.Tech Student</small>

                    <p class="mt-3">
                        "I found an AI workshop through EventSpark that helped me build my first machine learning project."
                    </p>

                    ⭐⭐⭐⭐⭐

                </div>
            </div>

            <div class="col-lg-4">

                <div class="testimonial-card">

                    <img src="https://randomuser.me/api/portraits/women/44.jpg">

                    <h5>Priya Shah</h5>

                    <small>BCA Student</small>

                    <p class="mt-3">
                        "The platform is simple to use and helped me discover coding competitions from top colleges."
                    </p>

                    ⭐⭐⭐⭐⭐

                </div>

            </div>

            <div class="col-lg-4">

                <div class="testimonial-card">

                    <img src="https://randomuser.me/api/portraits/men/50.jpg">

                    <h5>Meet Joshi</h5>

                    <small>MCA Student</small>

                    <p class="mt-3">
                        "I like that registration happens through the official college website. It feels trustworthy."
                    </p>

                    ⭐⭐⭐⭐⭐

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= NEWSLETTER ================= -->

<section class="newsletter">

    <div class="container text-center">

        <h2>Never Miss a Study Opportunity</h2>

        <p>
            Subscribe to receive updates about upcoming academic events.
        </p>

        <div class="row justify-content-center mt-4">

            <div class="col-lg-6">

                <div class="input-group">

                    <input
                        type="email"
                        class="form-control"
                        placeholder="Enter your email">

                    <button class="btn btn-warning">

                        Subscribe

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->

<footer>

<div class="container">

<div class="row">

<div class="col-lg-4">

<h3>EventSpark</h3>

<p>

Helping students discover workshops, seminars, hackathons,
career fairs and academic events organized by colleges.

</p>

</div>

<div class="col-lg-2">

<h5>Quick Links</h5>

<ul>

<li>Home</li>

<li>Events</li>

<li>Colleges</li>

<li>About</li>

<li>Contact</li>

</ul>

</div>

<div class="col-lg-3">

<h5>Popular Categories</h5>

<ul>

<li>Computer Science</li>

<li>Artificial Intelligence</li>

<li>Engineering</li>

<li>Management</li>

<li>Medical</li>

</ul>

</div>

<div class="col-lg-3">

<h5>Contact</h5>

<p>Email : info@eventspark.com</p>

<p>Phone : +91 9876543210</p>

<p>Rajkot, Gujarat</p>

<div class="social">

<i class="bi bi-facebook"></i>

<i class="bi bi-instagram"></i>

<i class="bi bi-linkedin"></i>

<i class="bi bi-twitter-x"></i>

</div>

</div>

</div>

<hr>

<p class="text-center">

© 2026 EventSpark. All Rights Reserved.

</p>

</div>

</footer>

<!-- Back To Top -->

<button id="topBtn">

<i class="bi bi-arrow-up"></i>

</button>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/script.js"></script>

</body>

</html>