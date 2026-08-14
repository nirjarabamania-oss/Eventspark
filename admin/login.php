<?php
session_start();
include("../config/database.php");

$error = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $admin['password'])) {

            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['username'] = $admin['username'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Invalid Password!";
        }

    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - EventSpark</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">
                    <h3>Admin Login</h3>
                </div>

                <div class="card-body">

                    <?php
                    if($error!=""){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            class="btn btn-dark w-100"
                            name="login">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>