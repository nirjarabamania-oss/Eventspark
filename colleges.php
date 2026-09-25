<?php
include("config/database.php");

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT
            college_id,
            college_name,
            university,
            city,
            state,
            logo
          FROM colleges";

if ($search !== '') {
    $search_safe = mysqli_real_escape_string($conn, $search);

    $query .= " WHERE college_name LIKE '%$search_safe%'
                OR university LIKE '%$search_safe%'
                OR city LIKE '%$search_safe%'
                OR state LIKE '%$search_safe%'";
}

$query .= " ORDER BY college_name ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<!-- ================= COLLEGES HERO ================= -->

<section class="py-5 bg-light">

    <div class="container py-4">

        <div class="text-center">

            <span class="badge bg-primary px-3 py-2 mb-3">
                EventSpark Colleges
            </span>

            <h1 class="fw-bold">
                Explore Colleges
            </h1>

            <p class="text-muted">
                Discover colleges and explore the events they organize.
            </p>

        </div>

    </div>

</section>


<!-- ================= SEARCH COLLEGES ================= -->

<section class="py-4">

    <div class="container">

        <form action="colleges.php" method="GET">

            <div class="row g-3 justify-content-center">

                <div class="col-md-8">

                    <input
                        type="text"
                        name="search"
                        class="form-control form-control-lg"
                        placeholder="Search by college, university, city or state"
                        value="<?php echo htmlspecialchars($search); ?>"
                    >

                </div>

                <div class="col-md-2 d-grid">

                    <button type="submit"
                            class="btn btn-primary btn-lg">

                        <i class="bi bi-search me-1"></i>
                        Search

                    </button>

                </div>

                <?php if ($search !== ''): ?>

                    <div class="col-md-2 d-grid">

                        <a href="colleges.php"
                           class="btn btn-outline-secondary btn-lg">

                            Clear

                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </form>

    </div>

</section>


<!-- ================= COLLEGES ================= -->

<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                <?php echo ($search !== '') ? "Search Results" : "All Colleges"; ?>
            </h2>

            <p class="text-muted">
                <?php
                if ($search !== '') {
                    echo "Showing colleges matching \"" .
                         htmlspecialchars($search) . "\".";
                } else {
                    echo "Browse all colleges registered on EventSpark.";
                }
                ?>
            </p>

        </div>


        <div class="row g-4">

            <?php if (mysqli_num_rows($result) > 0): ?>

                <?php while ($college = mysqli_fetch_assoc($result)): ?>

                    <div class="col-lg-4 col-md-6">

                        <div class="card college-card h-100 shadow-sm">

                            <!-- College Logo -->

                            <?php if (!empty($college['logo'])): ?>

                                <img
                                    src="uploads/college_logos/<?php echo htmlspecialchars($college['logo']); ?>"
                                    class="card-img-top"
                                    alt="<?php echo htmlspecialchars($college['college_name']); ?>"
                                    style="height:220px; object-fit:cover;"
                                >

                            <?php else: ?>

                                <div class="college-placeholder d-flex
                                            align-items-center
                                            justify-content-center"
                                     style="height:220px;">

                                    <i class="bi bi-building"
                                       style="font-size:70px;"></i>

                                </div>

                            <?php endif; ?>


                            <!-- College Information -->

                            <div class="card-body d-flex flex-column">

                                <h4 class="card-title fw-bold">

                                    <?php echo htmlspecialchars($college['college_name']); ?>

                                </h4>


                                <?php if (!empty($college['university'])): ?>

                                    <p class="text-muted mb-2">

                                        <i class="bi bi-mortarboard me-1"></i>

                                        <?php echo htmlspecialchars($college['university']); ?>

                                    </p>

                                <?php endif; ?>


                                <?php if (!empty($college['city']) || !empty($college['state'])): ?>

                                    <p class="text-muted">

                                        <i class="bi bi-geo-alt me-1"></i>

                                        <?php echo htmlspecialchars($college['city']); ?>

                                        <?php if (!empty($college['city']) && !empty($college['state'])): ?>
                                            ,
                                        <?php endif; ?>

                                        <?php echo htmlspecialchars($college['state']); ?>

                                    </p>

                                <?php endif; ?>


                                <div class="mt-auto">

                                    <a href="student/events.php"
                                       class="btn btn-primary w-100">

                                        <i class="bi bi-calendar-event me-1"></i>
                                        Explore Events

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-building-x text-muted"
                           style="font-size:60px;"></i>

                        <h4 class="mt-3">
                            No Colleges Found
                        </h4>

                        <p class="text-muted">
                            <?php if ($search !== ''): ?>
                                No colleges matched your search.
                            <?php else: ?>
                                No colleges are currently available.
                            <?php endif; ?>
                        </p>

                        <?php if ($search !== ''): ?>

                            <a href="colleges.php"
                               class="btn btn-primary">

                                View All Colleges

                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>


<?php include("includes/footer.php"); ?>


</body>
</html>