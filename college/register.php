<?php
include("../config/database.php");

$message = "";
$message_type = "";

if (isset($_POST['register'])) {

    $college_name = trim($_POST['college_name']);
    $university = trim($_POST['university']);
    $established_year = !empty($_POST['established_year']) ? $_POST['established_year'] : NULL;
    $description = trim($_POST['description']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $website = trim($_POST['website']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $map_link = trim($_POST['map_link']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password
    if ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "danger";

    } else {

        // Check whether email already exists
        $check = mysqli_prepare(
            $conn,
            "SELECT college_id FROM colleges WHERE email = ?"
        );

        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {

            $message = "A college with this email already exists.";
            $message_type = "danger";

        } else {

            // Password hashing
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // File upload folders
            $logo_folder = "../assets/uploads/colleges/logos/";
            $banner_folder = "../assets/uploads/colleges/banners/";

            // Create folders if they don't exist
            if (!is_dir($logo_folder)) {
                mkdir($logo_folder, 0777, true);
            }

            if (!is_dir($banner_folder)) {
                mkdir($banner_folder, 0777, true);
            }

            $logo_name = NULL;
            $banner_name = NULL;

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

                $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($logo_extension, $allowed_extensions)) {

                    $logo_name = uniqid('logo_') . '.' . $logo_extension;

                    move_uploaded_file(
                        $_FILES['logo']['tmp_name'],
                        $logo_folder . $logo_name
                    );
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

                    $banner_name = uniqid('banner_') . '.' . $banner_extension;

                    move_uploaded_file(
                        $_FILES['banner']['tmp_name'],
                        $banner_folder . $banner_name
                    );
                }
            }

            // Insert college
            $sql = "INSERT INTO colleges
                    (
                        college_name,
                        university,
                        established_year,
                        description,
                        email,
                        phone,
                        website,
                        address,
                        city,
                        state,
                        map_link,
                        logo,
                        banner,
                        password,
                        status
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "sissssssssssss",
                $college_name,
                $university,
                $established_year,
                $description,
                $email,
                $phone,
                $website,
                $address,
                $city,
                $state,
                $map_link,
                $logo_name,
                $banner_name,
                $hashed_password
            );

            if (mysqli_stmt_execute($stmt)) {

                $message = "College registration submitted successfully. Please wait for admin approval.";
                $message_type = "success";

            } else {

                $message = "Registration failed. Please try again.";
                $message_type = "danger";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>College Registration - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">

                    <h3 class="mb-0">College Registration</h3>

                </div>

                <div class="card-body p-4">

                    <?php if ($message != "") { ?>

                        <div class="alert alert-<?php echo $message_type; ?>">
                            <?php echo htmlspecialchars($message); ?>
                        </div>

                    <?php } ?>


                    <form method="POST"
                          enctype="multipart/form-data">


                        <!-- College Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                College Name *
                            </label>

                            <input
                                type="text"
                                name="college_name"
                                class="form-control"
                                required
                            >

                        </div>


                        <!-- University -->

                        <div class="mb-3">

                            <label class="form-label">
                                University
                            </label>

                            <input
                                type="text"
                                name="university"
                                class="form-control"
                            >

                        </div>


                        <!-- Established Year -->

                        <div class="mb-3">

                            <label class="form-label">
                                Established Year
                            </label>

                            <input
                                type="number"
                                name="established_year"
                                class="form-control"
                                min="1000"
                                max="9999"
                            >

                        </div>


                        <!-- Description -->

                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                            ></textarea>

                        </div>


                        <!-- Email -->

                        <div class="mb-3">

                            <label class="form-label">
                                Email *
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>


                        <!-- Phone -->

                        <div class="mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                maxlength="15"
                            >

                        </div>


                        <!-- Website -->

                        <div class="mb-3">

                            <label class="form-label">
                                Website
                            </label>

                            <input
                                type="url"
                                name="website"
                                class="form-control"
                                placeholder="https://example.com"
                            >

                        </div>


                        <!-- Address -->

                        <div class="mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                            ></textarea>

                        </div>


                        <div class="row">

                            <!-- City -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    City
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                >

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
                                >

                            </div>

                        </div>


                        <!-- Map Link -->

                        <div class="mb-3">

                            <label class="form-label">
                                Google Maps Link
                            </label>

                            <input
                                type="url"
                                name="map_link"
                                class="form-control"
                                placeholder="https://maps.google.com/..."
                            >

                        </div>


                        <div class="row">

                            <!-- Logo -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    College Logo
                                </label>

                                <input
                                    type="file"
                                    name="logo"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                            </div>


                            <!-- Banner -->

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    College Banner
                                </label>

                                <input
                                    type="file"
                                    name="banner"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                >

                            </div>

                        </div>


                        <!-- Password -->

                        <div class="mb-3">

                            <label class="form-label">
                                Password *
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>


                        <!-- Confirm Password -->

                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password *
                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                required
                            >

                        </div>


                        <button
                            type="submit"
                            name="register"
                            class="btn btn-dark w-100"
                        >
                            Register College
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>