<?php
session_start();
include("../config/database.php");

// Check Login
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid Event.");
}

$student_id = $_SESSION['student_id'];
$event_id = intval($_GET['id']);

// Get Event Details
$eventQuery = mysqli_query($conn, "
SELECT *
FROM events
WHERE event_id='$event_id'
");

if(mysqli_num_rows($eventQuery)==0){
    die("Event not found.");
}

$event = mysqli_fetch_assoc($eventQuery);

// Check Registration Deadline
$currentDate = date("Y-m-d");

if($currentDate > $event['registration_deadline']){
    echo "<script>
    alert('Registration deadline has passed.');
    window.location='event_details.php?id=$event_id';
    </script>";
    exit();
}

// Check Already Registered
$check = mysqli_query($conn,"
SELECT *
FROM registrations
WHERE student_id='$student_id'
AND event_id='$event_id'
");

if(mysqli_num_rows($check)>0){
    echo "<script>
    alert('You are already registered for this event.');
    window.location='my_registrations.php';
    </script>";
    exit();
}

// Count Registered Students
$countQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM registrations
WHERE event_id='$event_id'
AND status='Registered'
");

$count = mysqli_fetch_assoc($countQuery);

// Check Maximum Participants
if($count['total'] >= $event['max_participants']){
    echo "<script>
    alert('Registration Full.');
    window.location='event_details.php?id=$event_id';
    </script>";
    exit();
}

// Register Student
$insert = mysqli_query($conn,"
INSERT INTO registrations
(event_id, student_id)
VALUES
('$event_id','$student_id')
");

if($insert){
    echo "<script>
    alert('Registration Successful!');
    window.location='my_registrations.php';
    </script>";
}
else{
    echo "<script>
    alert('Something went wrong.');
    window.location='event_details.php?id=$event_id';
    </script>";
}
?>
<?php
session_start();
include("../config/database.php");

// Check Login
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Invalid Event.");
}

$student_id = $_SESSION['student_id'];
$event_id = intval($_GET['id']);

// Get Event Details
$eventQuery = mysqli_query($conn, "
SELECT *
FROM events
WHERE event_id='$event_id'
");

if(mysqli_num_rows($eventQuery)==0){
    die("Event not found.");
}

$event = mysqli_fetch_assoc($eventQuery);

// Check Registration Deadline
$currentDate = date("Y-m-d");

if($currentDate > $event['registration_deadline']){
    echo "<script>
    alert('Registration deadline has passed.');
    window.location='event_details.php?id=$event_id';
    </script>";
    exit();
}

// Check Already Registered
$check = mysqli_query($conn,"
SELECT *
FROM registrations
WHERE student_id='$student_id'
AND event_id='$event_id'
");

if(mysqli_num_rows($check)>0){
    echo "<script>
    alert('You are already registered for this event.');
    window.location='my_registrations.php';
    </script>";
    exit();
}

// Count Registered Students
$countQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM registrations
WHERE event_id='$event_id'
AND status='Registered'
");

$count = mysqli_fetch_assoc($countQuery);

// Check Maximum Participants
if($count['total'] >= $event['max_participants']){
    echo "<script>
    alert('Registration Full.');
    window.location='event_details.php?id=$event_id';
    </script>";
    exit();
}

// Register Student
$insert = mysqli_query($conn,"
INSERT INTO registrations
(event_id, student_id)
VALUES
('$event_id','$student_id')
");

if($insert){
    echo "<script>
    alert('Registration Successful!');
    window.location='my_registrations.php';
    </script>";
}
else{
    echo "<script>
    alert('Something went wrong.');
    window.location='event_details.php?id=$event_id';
    </script>";
}
?>
