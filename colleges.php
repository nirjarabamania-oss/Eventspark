<?php
include("config/database.php");

$college_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

/* =========================================================
   SINGLE COLLEGE DETAILS
   ========================================================= */

if ($college_id > 0) {

    $query = "SELECT
                college_id,
                college_name,
                university,
                city,
                state,
                logo
              FROM colleges
              WHERE college_id = $college_id
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 0) {
        die("College not found.");
    }

    $college = mysqli_fetch_assoc($result);
}


/* =========================================================
   ALL COLLEGES
   ========================================================= */

else {

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
}
?>

<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>


<?php if ($college_id > 0): ?>

<!-- =========================================================
     SINGLE COLLEGE DETAILS
     ========================================================= -->

<section class="py-5 bg-light">

    <div class="container py-4">

        <div class="mb-4">

            <a href="colleges.php"
               class="btn btn-outline-primary">

                <i class="bi bi-arrow-left me-1"></i>
                Back to Colleges

            </a>

        </div>


        <div class="row g-4 align-items-start">

            <!-- College Logo -->

            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">

                    <?php if (!empty($college['logo'])): ?>

                        <img
                            src="uploads/college_logos/<?php echo htmlspecialchars($college['logo']); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($college['college_name']); ?>"
                            style="height:350px; object-fit:cover;"
                        >

                    <?php else: ?>

                        <div class="d-flex align-items-center
                                    justify-content-center bg-light"
                             style="height:350px;">

                            <i class="bi bi-building text-primary"
                               style="font-size:100px;"></i>

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- College Information -->

            <div class="col-lg-7">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4 p-lg-5">

                        <span class="badge bg-primary mb-3">
                            College Information
                        </span>

                        <h1 class="fw-bold mb-4">
                            <?php echo htmlspecialchars($college['college_name']); ?>
                        </h1>


                        <?php if (!empty($college['university'])): ?>

                            <div class="d-flex mb-4">

                                <div class="me-3">
                                    <i class="bi bi-mortarboard-fill
                                              text-primary fs-3"></i>
                                </div>

                                <div>
                                    <small class="text-muted">
                                        University
                                    </small>

                                    <h5 class="mb-0">
                                        <?php echo htmlspecialchars($college['university']); ?>
                                    </h5>
                                </div>

                            </div>

                        <?php endif; ?>


                        <?php if (!empty($college['city']) || !empty($college['state'])): ?>

                            <div class="d-flex mb-4">

                                <div class="me-3">
                                    <i class="bi bi-geo-alt-fill
                                              text-primary fs-3"></i>
                                </div>

                                <div>
                                    <small class="text-muted">
                                        Location
                                    </small>

                                    <h5 class="mb-0">

                                        <?php echo htmlspecialchars($college['city']); ?>

                                        <?php if (!empty($college['city']) && !empty($college['state'])): ?>
                                            ,
                                        <?php endif; ?>

                                        <?php echo htmlspecialchars($college['state']); ?>

                                    </h5>
                                </div>

                            </div>

                        <?php endif; ?>


                        <div class="mt-4 pt-3 border-top">

                            <a href="student/events.php"
                               class="btn btn-primary">

                                <i class="bi bi-calendar-event me-1"></i>
                                Explore Events

                            </a>

                            <a href="colleges.php"
                               class="btn btn-outline-secondary ms-2">

                                View All Colleges

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<?php else: ?>


<!-- =========================================================
     ALL COLLEGES PAGE
     ========================================================= -->

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


<!-- SEARCH COLLEGES -->

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


<!-- COLLEGES -->

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

                                    <a href="colleges.php?id=<?php echo $college['college_id']; ?>"
                                       class="btn btn-primary w-100">

                                        <i class="bi bi-building me-1"></i>
                                        View College

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12 text-center">

                    <div class="py-5">

                        <i class="bi bi-building-x text-muted"
                           style="font-size:60px;"></i>

                        <h4 class="mt-3">
                            No Colleges Found
                        </h4>

                        <p class="text-muted">
                            No colleges matched your search.
                        </p>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>

<?php endif; ?>


<?php include("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>