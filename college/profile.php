<?php
include("college_auth.php");
include("../config/database.php");

$college_id = $_SESSION['college_id'];

// Fetch logged-in college details
$sql = "SELECT * FROM colleges WHERE college_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $college_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$college = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$college) {
    echo "College information not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Profile - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .profile-card {
            border: none;
            border-radius: 12px;
        }

        .college-banner {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .college-logo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            margin-top: -60px;
            background: white;
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- Back to Dashboard -->

    <div class="mb-3">

        <a href="dashboard.php"
           class="btn btn-dark">

            ← Dashboard

        </a>

    </div>


    <div class="card profile-card shadow">

        <!-- Banner -->

        <?php if (!empty($college['banner'])) { ?>

            <img
                src="../assets/uploads/colleges/banners/<?php echo htmlspecialchars($college['banner']); ?>"
                class="college-banner"
                alt="College Banner">

        <?php } else { ?>

            <div
                class="college-banner bg-secondary
                       d-flex align-items-center
                       justify-content-center
                       text-white">

                No Banner Available

            </div>

        <?php } ?>


        <div class="card-body">

            <!-- Logo -->

            <div class="text-center">

                <?php if (!empty($college['logo'])) { ?>

                    <img
                        src="../assets/uploads/colleges/logos/<?php echo htmlspecialchars($college['logo']); ?>"
                        class="college-logo"
                        alt="College Logo">

                <?php } else { ?>

                    <div class="college-logo mx-auto
                                bg-secondary text-white
                                d-flex align-items-center
                                justify-content-center">

                        No Logo

                    </div>

                <?php } ?>


                <h2 class="mt-3">

                    <?php
                    echo htmlspecialchars($college['college_name']);
                    ?>

                </h2>

                <p class="text-muted">

                    <?php
                    echo htmlspecialchars(
                        $college['university'] ?? ''
                    );
                    ?>

                </p>


                <!-- Status -->

                <?php

                if ($college['status'] === 'Approved') {

                    echo '<span class="badge bg-success">
                            Approved
                          </span>';

                } elseif ($college['status'] === 'Pending') {

                    echo '<span class="badge bg-warning text-dark">
                            Pending
                          </span>';

                } else {

                    echo '<span class="badge bg-danger">
                            Rejected
                          </span>';
                }

                ?>

            </div>


            <hr class="my-4">


            <!-- College Details -->

            <h4 class="mb-4">
                College Information
            </h4>


            <div class="row">

                <!-- University -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        University
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['university'] ?? 'Not provided'
                        );
                        ?>
                    </div>

                </div>


                <!-- Established Year -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        Established Year
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['established_year'] ?? 'Not provided'
                        );
                        ?>
                    </div>

                </div>


                <!-- Email -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        Email
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['email']
                        );
                        ?>
                    </div>

                </div>


                <!-- Phone -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        Phone
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['phone'] ?? 'Not provided'
                        );
                        ?>
                    </div>

                </div>


                <!-- Website -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        Website
                    </div>

                    <div>

                        <?php if (!empty($college['website'])) { ?>

                            <a
                                href="<?php echo htmlspecialchars($college['website']); ?>"
                                target="_blank">

                                <?php
                                echo htmlspecialchars(
                                    $college['website']
                                );
                                ?>

                            </a>

                        <?php } else { ?>

                            Not provided

                        <?php } ?>

                    </div>

                </div>


                <!-- City -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        City
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['city'] ?? 'Not provided'
                        );
                        ?>
                    </div>

                </div>


                <!-- State -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        State
                    </div>

                    <div>
                        <?php
                        echo htmlspecialchars(
                            $college['state'] ?? 'Not provided'
                        );
                        ?>
                    </div>

                </div>


                <!-- Address -->

                <div class="col-md-6 mb-4">

                    <div class="info-label">
                        Address
                    </div>

                    <div>
                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                $college['address'] ?? 'Not provided'
                            )
                        );
                        ?>
                    </div>

                </div>


                <!-- Description -->

                <div class="col-12 mb-4">

                    <div class="info-label">
                        Description
                    </div>

                    <div>
                        <?php
                        echo nl2br(
                            htmlspecialchars(
                                $college['description'] ?? 'Not provided'
                            )
                        );
                        ?>
                    </div>

                </div>


                <!-- Map -->

                <div class="col-12 mb-4">

                    <div class="info-label">
                        Location
                    </div>

                    <?php if (!empty($college['map_link'])) { ?>

                        <a
                            href="<?php echo htmlspecialchars($college['map_link']); ?>"
                            target="_blank"
                            class="btn btn-outline-primary mt-2">

                            📍 View on Google Maps

                        </a>

                    <?php } else { ?>

                        <p class="text-muted mt-2">
                            Map location not provided.
                        </p>

                    <?php } ?>

                </div>

            </div>


            <!-- Edit Profile -->

            <div class="text-center mt-3">

                <a
                    href="edit_profile.php"
                    class="btn btn-dark">

                    Edit Profile

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>