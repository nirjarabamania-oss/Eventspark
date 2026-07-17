<?php
include 'config/database.php';
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

<form action="" method="POST">

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

<label>College Name</label>

<input
type="text"
name="college"
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