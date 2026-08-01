<?php
session_start();
include("../config/database.php");

// Check Login
if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Student Details
$sql = "SELECT * FROM students WHERE student_id='$student_id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

// Total Active Events
$sql1 = "SELECT COUNT(*) AS total FROM events WHERE status='Active'";
$res1 = mysqli_query($conn, $sql1);
$totalEvents = mysqli_fetch_assoc($res1)['total'];

// Registered Events
$sql2 = "SELECT COUNT(*) AS total FROM event_registration WHERE student_id='$student_id'";
$res2 = mysqli_query($conn, $sql2);
$totalRegistered = mysqli_fetch_assoc($res2)['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body{
            font-family:Arial;
            background:#f5f5f5;
            margin:0;
        }

        .header{
            background:#007bff;
            color:white;
            padding:15px;
        }

        .container{
            width:90%;
            margin:auto;
        }

        .card{
            width:250px;
            display:inline-block;
            background:white;
            margin:20px;
            padding:20px;
            border-radius:8px;
            text-align:center;
            box-shadow:0 0 10px #ccc;
        }

        a{
            text-decoration:none;
        }

        .btn{
            background:#007bff;
            color:white;
            padding:10px 20px;
            border-radius:5px;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Welcome, <?php echo $student['name']; ?></h2>
</div>

<div class="container">

<div class="card">
<h3>Available Events</h3>
<h1><?php echo $totalEvents; ?></h1>
</div>

<div class="card">
<h3>Registered Events</h3>
<h1><?php echo $totalRegistered; ?></h1>
</div>

<br><br>

<a class="btn" href="events.php">View Events</a>
<a class="btn" href="my_events.php">My Events</a>
<a class="btn" href="profile.php">Profile</a>
<a class="btn" href="logout.php">Logout</a>

</div>

</body>
</html>
