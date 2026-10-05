<?php

include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

$sql = "SELECT *
        FROM college_gallery
        WHERE college_id = ?
        ORDER BY uploaded_at DESC";

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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Gallery - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .gallery-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }

        .gallery-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .gallery-card:hover {
            transform: translateY(-3px);
            transition: 0.2s;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between
                align-items-center mb-4">

        <div>

            <h2>
                <i class="bi bi-images"></i>
                My Gallery
            </h2>

            <p class="text-muted">
                Manage your college gallery images.
            </p>

        </div>

        <div>

            <a href="add.php"
               class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>
                Add Image

            </a>

            <a href="../dashboard.php"
               class="btn btn-dark">

                Dashboard

            </a>

        </div>

    </div>


    <div class="row g-4">

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-6 col-lg-4">

                    <div class="card gallery-card shadow-sm">

                        <img
                            src="../../assets/uploads/colleges/gallery/<?php echo htmlspecialchars($row['image']); ?>"
                            class="gallery-image"
                            alt="College Gallery Image">


                        <div class="card-body">

                            <?php if (!empty($row['caption'])) { ?>

                                <h5 class="card-title">

                                    <?php
                                    echo htmlspecialchars(
                                        $row['caption']
                                    );
                                    ?>

                                </h5>

                            <?php } else { ?>

                                <h5 class="card-title text-muted">
                                    No Caption
                                </h5>

                            <?php } ?>


                            <p class="text-muted mb-3">

                                <i class="bi bi-calendar"></i>

                                <?php
                                echo date(
                                    "d M Y",
                                    strtotime($row['uploaded_at'])
                                );
                                ?>

                            </p>


                            <a
                                href="delete.php?id=<?php echo $row['image_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this image?');">

                                <i class="bi bi-trash"></i>
                                Delete

                            </a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">

                <div class="alert alert-info text-center">

                    <i class="bi bi-images"></i>

                    No gallery images uploaded yet.

                    <br><br>

                    <a href="add.php"
                       class="btn btn-primary">

                        Add Your First Image

                    </a>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);

?>