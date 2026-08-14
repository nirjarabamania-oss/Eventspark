<?php
session_start();
include("../config/database.php");

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM colleges WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $college = mysqli_fetch_assoc($result);

        // Check college approval status
        if ($college['status'] !== 'Approved') {

            if ($college['status'] === 'Pending') {
                $error = "Your college registration is still pending admin approval.";
            } else {
                $error = "Your college registration has been rejected.";
            }

        } elseif (password_verify($password, $college['password'])) {

            // Store college information in session
            $_SESSION['college_id'] = $college['college_id'];
            $_SESSION['college_name'] = $college['college_name'];
            $_SESSION['college_email'] = $college['email'];

            header("Location: dashboard.php");
            exit();

        } else {

            $error = "Invalid email or password.";
        }

    } else {

        $error = "Invalid email or password.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>College Login - EventSpark</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">

                    <h3>College Login</h3>

                </div>

                <div class="card-body p-4">

                    <?php if ($error != "") { ?>

                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-dark w-100"
                        >
                            Login
                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <p>
                            Don't have a college account?
                            <a href="register.php">
                                Register here
                            </a>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>