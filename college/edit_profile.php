<?php
include("college_auth.php");
include("../config/database.php");

$college_id = $_SESSION['college_id'];
$message = "";
$message_type = "";

// Fetch current college information
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


// Update profile
if (isset($_POST['update_profile'])) {

    $phone = trim($_POST['phone']);
    $website = trim($_POST['website']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $map_link = trim($_POST['map_link']);
    $description = trim($_POST['description']);

    // Keep existing files
    $logo_name = $college['logo'];
    $banner_name = $college['banner'];

    $logo_folder = "../assets/uploads/colleges/logos/";
    $banner_folder = "../assets/uploads/colleges/banners/";

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];


    // Logo upload
    if (
        isset($_FILES['logo']) &&
        $_FILES['logo']['error'] === 0
    ) {

        $logo_extension = strtolower(
            pathinfo(
                $_FILES['logo']['name'],
                PATHINFO_EXTENSION
            )
        );

        if (in_array($logo_extension, $allowed_extensions)) {

            $new_logo_name = uniqid('logo_') . '.' . $logo_extension;

            if (
                move_uploaded_file(
                    $_FILES['logo']['tmp_name'],
                    $logo_folder . $new_logo_name
                )
            ) {

                // Delete old logo
                if (
                    !empty($logo_name) &&
                    file_exists($logo_folder . $logo_name)
                ) {
                    unlink($logo_folder . $logo_name);
                }

                $logo_name = $new_logo_name;
            }
        }
    }


    // Banner upload
    if (
        isset($_FILES['banner']) &&
        $_FILES['banner']['error'] === 0
    ) {

        $banner_extension = strtolower(
            pathinfo(
                $_FILES['banner']['name'],
                PATHINFO_EXTENSION
            )
        );

        if (in_array($banner_extension, $allowed_extensions)) {

            $new_banner_name = uniqid('banner_') . '.' . $banner_extension;

            if (
                move_uploaded_file(
                    $_FILES['banner']['tmp_name'],
                    $banner_folder . $new_banner_name
                )
            ) {

                // Delete old banner
                if (
                    !empty($banner_name) &&
                    file_exists($banner_folder . $banner_name)
                ) {
                    unlink($banner_folder . $banner_name);
                }

                $banner_name = $new_banner_name;
            }
        }
    }


    // Update database
    $update_sql = "UPDATE colleges SET
                    phone = ?,
                    website = ?,
                    address = ?,
                    city = ?,
                    state = ?,
                    map_link = ?,
                    description = ?,
                    logo = ?,
                    banner = ?
                   WHERE college_id = ?";

    $update_stmt = mysqli_prepare($conn, $update_sql);

    mysqli_stmt_bind_param(
        $update_stmt,
        "sssssssssi",
        $phone,
        $website,
        $address,
        $city,
        $state,
        $map_link,
        $description,
        $logo_name,
        $banner_name,
        $college_id
    );

    if (mysqli_stmt_execute($update_stmt)) {

        $message = "Profile updated successfully.";
        $message_type = "success";

        // Refresh college information
        $refresh_sql = "SELECT * FROM colleges WHERE college_id = ?";

        $refresh_stmt = mysqli_prepare($conn, $refresh_sql);
        mysqli_stmt_bind_param(
            $refresh_stmt,
            "i",
            $college_id
        );

        mysqli_stmt_execute($refresh_stmt);

        $refresh_result = mysqli_stmt_get_result($refresh_stmt);
        $college = mysqli_fetch_assoc($refresh_result);

        mysqli_stmt_close($refresh_stmt);

    } else {

        $message = "Profile update failed.";
        $message_type = "danger";
    }

    mysqli_stmt_close($update_stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit College Profile - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background-color: #f5f6fa;
        }

        .edit-card {
            border: none;
            border-radius: 12px;
        }

        .current-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="mb-3">

        <a href="profile.php"
           class="btn btn-dark">

            ← Back to Profile

        </a>

    </div>


    <div class="card edit-card shadow">

        <div class="card-header bg-dark text-white">

            <h4 class="mb-0">
                Edit College Profile
            </h4>

        </div>


        <div class="card-body p-4">

            <?php if ($message != "") { ?>

                <div class="alert alert-<?php echo $message_type; ?>">

                    <?php
                    echo htmlspecialchars($message);
                    ?>

                </div>

            <?php } ?>


            <form method="POST"
                  enctype="multipart/form-data">


                <!-- Protected Information -->

                <h5 class="mb-3">
                    College Information
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            College Name
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['college_name']); ?>"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            University
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['university'] ?? ''); ?>"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['email']); ?>"
                            readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['status']); ?>"
                            readonly>

                    </div>

                </div>


                <hr class="my-4">


                <!-- Editable Information -->

                <h5 class="mb-3">
                    Contact & College Details
                </h5>


                <!-- Description -->

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"><?php
                        echo htmlspecialchars(
                            $college['description'] ?? ''
                        );
                        ?></textarea>

                </div>


                <div class="row">

                    <!-- Phone -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            maxlength="15"
                            value="<?php echo htmlspecialchars($college['phone'] ?? ''); ?>">

                    </div>


                    <!-- Website -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Website
                        </label>

                        <input
                            type="url"
                            name="website"
                            class="form-control"
                            placeholder="https://example.com"
                            value="<?php echo htmlspecialchars($college['website'] ?? ''); ?>">

                    </div>


                    <!-- City -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['city'] ?? ''); ?>">

                    </div>


                    <!-- State -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            State
                        </label>

                        <input
                            type="text"
                            name="state"
                            class="form-control"
                            value="<?php echo htmlspecialchars($college['state'] ?? ''); ?>">

                    </div>

                </div>


                <!-- Address -->

                <div class="mb-3">

                    <label class="form-label">
                        Address
                    </label>

                    <textarea
                        name="address"
                        class="form-control"
                        rows="3"><?php
                        echo htmlspecialchars(
                            $college['address'] ?? ''
                        );
                        ?></textarea>

                </div>


                <!-- Map Link -->

                <div class="mb-4">

                    <label class="form-label">
                        Google Maps Link
                    </label>

                    <input
                        type="url"
                        name="map_link"
                        class="form-control"
                        placeholder="https://maps.google.com/..."
                        value="<?php echo htmlspecialchars($college['map_link'] ?? ''); ?>">

                </div>


                <hr class="my-4">


                <!-- Logo -->

                <h5 class="mb-3">
                    College Images
                </h5>


                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            College Logo
                        </label>

                        <?php if (!empty($college['logo'])) { ?>

                            <div class="mb-2">

                                <img
                                    src="../assets/uploads/colleges/logos/<?php echo htmlspecialchars($college['logo']); ?>"
                                    class="current-image"
                                    alt="Current Logo">

                            </div>

                        <?php } ?>

                        <input
                            type="file"
                            name="logo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp">

                        <small class="text-muted">
                            Leave empty to keep the current logo.
                        </small>

                    </div>


                    <!-- Banner -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            College Banner
                        </label>

                        <?php if (!empty($college['banner'])) { ?>

                            <div class="mb-2">

                                <img
                                    src="../assets/uploads/colleges/banners/<?php echo htmlspecialchars($college['banner']); ?>"
                                    class="current-image"
                                    alt="Current Banner">

                            </div>

                        <?php } ?>

                        <input
                            type="file"
                            name="banner"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp">

                        <small class="text-muted">
                            Leave empty to keep the current banner.
                        </small>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        name="update_profile"
                        class="btn btn-dark">

                        Save Changes

                    </button>

                    <a
                        href="profile.php"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>