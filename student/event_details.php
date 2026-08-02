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

$event_id = intval($_GET['id']);
$student_id = $_SESSION['student_id'];

// Fetch Event Details
$query = "SELECT e.*, 
                 c.category_name, 
                 col.college_name
          FROM events e
          INNER JOIN categories c ON e.category_id = c.category_id
          INNER JOIN colleges col ON e.college_id = col.college_id
          WHERE e.event_id = '$event_id'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)==0){
    die("Event not found.");
}

$event = mysqli_fetch_assoc($result);

// Check Registration
$check = mysqli_query($conn,
"SELECT * FROM registrations
 WHERE event_id='$event_id'
 AND student_id='$student_id'");

$registered = mysqli_num_rows($check) > 0;
?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $event['event_title']; ?></title>

<link rel="stylesheet" href="../css/student.css">

<style>

.container{
    width:80%;
    margin:auto;
    margin-top:30px;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0px 0px 10px #ccc;
}

img{
    width:100%;
    max-height:350px;
    object-fit:cover;
    border-radius:10px;
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#007bff;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
}

.btn:hover{
    background:#0056b3;
}

.registered{
    background:green;
    color:white;
    padding:10px 20px;
    display:inline-block;
    border-radius:5px;
    margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<img src="../uploads/event_posters/<?php echo $event['poster']; ?>">

<h2><?php echo $event['event_title']; ?></h2>

<p><?php echo nl2br($event['description']); ?></p>

<table>

<tr>
<td><strong>College</strong></td>
<td><?php echo $event['college_name']; ?></td>
</tr>

<tr>
<td><strong>Category</strong></td>
<td><?php echo $event['category_name']; ?></td>
</tr>

<tr>
<td><strong>Venue</strong></td>
<td><?php echo $event['venue']; ?></td>
</tr>

<tr>
<td><strong>City</strong></td>
<td><?php echo $event['city']; ?></td>
</tr>

<tr>
<td><strong>Date</strong></td>
<td><?php echo $event['event_date']; ?></td>
</tr>

<tr>
<td><strong>Time</strong></td>
<td><?php echo $event['start_time']; ?> -
<?php echo $event['end_time']; ?></td>
</tr>

<tr>
<td><strong>Registration Deadline</strong></td>
<td><?php echo $event['registration_deadline']; ?></td>
</tr>

<tr>
<td><strong>Registration Fee</strong></td>
<td>₹ <?php echo $event['registration_fee']; ?></td>
</tr>

<tr>
<td><strong>Maximum Participants</strong></td>
<td><?php echo $event['max_participants']; ?></td>
</tr>

</table>

<?php

if($registered)
{
    echo "<div class='registered'>Already Registered</div>";
}
else
{
?>

<a class="btn"
href="register_event.php?id=<?php echo $event['event_id']; ?>">
Register Now
</a>

<?php
}
?>

<br><br>

<a href="events.php">← Back to Events</a>

</div>

</div>

</body>

</html>
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

$event_id = intval($_GET['id']);
$student_id = $_SESSION['student_id'];

// Fetch Event Details
$query = "SELECT e.*, 
                 c.category_name, 
                 col.college_name
          FROM events e
          INNER JOIN categories c ON e.category_id = c.category_id
          INNER JOIN colleges col ON e.college_id = col.college_id
          WHERE e.event_id = '$event_id'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)==0){
    die("Event not found.");
}

$event = mysqli_fetch_assoc($result);

// Check Registration
$check = mysqli_query($conn,
"SELECT * FROM registrations
 WHERE event_id='$event_id'
 AND student_id='$student_id'");

$registered = mysqli_num_rows($check) > 0;
?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $event['event_title']; ?></title>

<link rel="stylesheet" href="../css/student.css">

<style>

.container{
    width:80%;
    margin:auto;
    margin-top:30px;
}

.card{
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0px 0px 10px #ccc;
}

img{
    width:100%;
    max-height:350px;
    object-fit:cover;
    border-radius:10px;
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 20px;
    background:#007bff;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
}

.btn:hover{
    background:#0056b3;
}

.registered{
    background:green;
    color:white;
    padding:10px 20px;
    display:inline-block;
    border-radius:5px;
    margin-top:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<img src="../uploads/event_posters/<?php echo $event['poster']; ?>">

<h2><?php echo $event['event_title']; ?></h2>

<p><?php echo nl2br($event['description']); ?></p>

<table>

<tr>
<td><strong>College</strong></td>
<td><?php echo $event['college_name']; ?></td>
</tr>

<tr>
<td><strong>Category</strong></td>
<td><?php echo $event['category_name']; ?></td>
</tr>

<tr>
<td><strong>Venue</strong></td>
<td><?php echo $event['venue']; ?></td>
</tr>

<tr>
<td><strong>City</strong></td>
<td><?php echo $event['city']; ?></td>
</tr>

<tr>
<td><strong>Date</strong></td>
<td><?php echo $event['event_date']; ?></td>
</tr>

<tr>
<td><strong>Time</strong></td>
<td><?php echo $event['start_time']; ?> -
<?php echo $event['end_time']; ?></td>
</tr>

<tr>
<td><strong>Registration Deadline</strong></td>
<td><?php echo $event['registration_deadline']; ?></td>
</tr>

<tr>
<td><strong>Registration Fee</strong></td>
<td>₹ <?php echo $event['registration_fee']; ?></td>
</tr>

<tr>
<td><strong>Maximum Participants</strong></td>
<td><?php echo $event['max_participants']; ?></td>
</tr>

</table>

<?php

if($registered)
{
    echo "<div class='registered'>Already Registered</div>";
}
else
{
?>

<a class="btn"
href="register_event.php?id=<?php echo $event['event_id']; ?>">
Register Now
</a>

<?php
}
?>

<br><br>

<a href="events.php">← Back to Events</a>

</div>

</div>

</body>

</html>
