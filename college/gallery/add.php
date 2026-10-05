<?php

include("../college_auth.php");
include("../../config/database.php");

$college_id = $_SESSION['college_id'];

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $caption = trim($_POST['caption'] ?? "");

    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {

        $error = "Please select an image.";

    } else {

        $file = $_FILES['image'];

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];

        $extension = strtolower(
            pathinfo($fileName, PATHINFO_EXTENSION)
        );

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed)) {

            $error = "Only JPG, JPEG, PNG and WEBP images are allowed.";

        } elseif ($fileSize > 5 * 1024 * 1024) {

            $error = "Image size must be less than 5 MB.";

        } else {

            $newFileName =
                'college_' .
                $college_id . '_' .
                time() . '_' .
                uniqid() . '.' .
                $extension;

            $uploadDir = "../../assets/uploads/colleges/gallery/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmp, $uploadPath)) {

                $sql = "INSERT INTO college_gallery
                        (college_id, image, caption)
                        VALUES (?, ?, ?)";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param(
                    $stmt,
                    "iss",
                    $college_id,
                    $newFileName,
                    $caption
                );

                if (mysqli_stmt_execute($stmt)) {

                    $message = "Image uploaded successfully.";

                } else {

                    if (file_exists($uploadPath)) {
                        unlink($uploadPath);
                    }

                    $error = "Failed to save image information.";
                }

                mysqli_stmt_close($stmt);

            } else {

                $error = "Failed to upload image.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Gallery Image - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                <i class="bi bi-images"></i>
                Add Gallery Image
            </h4>

        </div>

        <div class="card-body">

            <?php if ($message != "") { ?>

                <div class="alert alert-success">
                    <?php echo htmlspecialchars($message); ?>
                </div>

            <?php } ?>

            <?php if ($error != "") { ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php } ?>


            <form method="POST"
                  enctype="multipart/form-data">

                <div class="mb-3">

                    <label class="form-label">
                        Select Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        required>

                    <small class="text-muted">
                        JPG, JPEG, PNG or WEBP. Maximum 5 MB.
                    </small>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Caption
                    </label>

                    <input
                        type="text"
                        name="caption"
                        class="form-control"
                        maxlength="150"
                        placeholder="Enter image caption">

                </div>


                <button type="submit"
                        class="btn btn-primary">

                    <i class="bi bi-upload"></i>
                    Upload Image

                </button>


                <a href="view.php"
                   class="btn btn-secondary">

                    View Gallery

                </a>


                <a href="../dashboard.php"
                   class="btn btn-outline-dark">

                    Dashboard

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>