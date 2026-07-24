
<?php

include 'config/database.php';

if(isset($_POST['register']))
{
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
    else
    {
        // Check email already exists
        $check = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");

        if(mysqli_num_rows($check) > 0)
        {
            echo "<script>alert('Email already registered');</script>";
        }
        else
        {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = "INSERT INTO students
            (full_name,email,phone,course,year,password)
            VALUES
            ('$full_name','$email','$phone','$course','$year','$hashPassword')";

            if(mysqli_query($conn, $insert))
            {
                echo "<script>
                alert('Registration Successful');
                window.location='login.php';
                </script>";
            }
            else
            {
                echo "<script>alert('Something went wrong');</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register | EventSpark</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<section class="register-page">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="register-card">

<div class="text-center mb-4">

<h2>Create Your Account</h2>

<p>

Discover academic events from colleges across India.

</p>

</div>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input
type="text"
name="fullname"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email Address</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile Number</label>

<input
type="text"
name="mobile"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Course</label>

<select
class="form-select"
name="course">

<option>BCA</option>
<option>B.Tech</option>
<option>BBA</option>
<option>B.Com</option>
<option>MCA</option>
<option>MBA</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Year</label>

<select
class="form-select"
name="year">

<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
<option>4th Year</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<div class="mb-3">

<input
type="checkbox"
required>

I agree to the Terms & Conditions

</div>

<button
type="submit"
name="register"
class="btn btn-primary w-100">

Create Account

</button>

<div class="text-center mt-3">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>