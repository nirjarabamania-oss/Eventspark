<?php
session_start();
include("../config/database.php");

// Check Login
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch Student Registrations
$query = "
SELECT
    r.registration_id,
    r.status,
    r.registration_date,
    e.event_id,
    e.event_title,
    e.event_date,
    e.venue,
    c.category_name,
    col.college_name
FROM registrations r
INNER JOIN events e ON r.event_id = e.event_id
INNER JOIN categories c ON e.category_id = c.category_id
INNER JOIN colleges col ON e.college_id = col.college_id
WHERE r.student_id = '$student_id'
ORDER BY e.event_date ASC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registrations</title>

    <link rel="stylesheet" href="../css/student.css">

    <style>

        body{
            font-family: Arial;
            background:#f4f4f4;
        }

        .container{
            width:90%;
            margin:30px auto;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th{
            background:#007BFF;
            color:white;
        }

        th,td{
            padding:12px;
            border:1px solid #ddd;
            text-align:center;
        }

        tr:hover{
            background:#f1f1f1;
        }

        .btn{
            padding:8px 15px;
            background:#007BFF;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .back{
            margin-bottom:20px;
            display:inline-block;
        }

    </style>

</head>

<body>

<div class="container">

<a href="dashboard.php" class="btn back">← Dashboard</a>

<h2>My Registered Events</h2>

<table>

<tr>
    <th>Event</th>
    <th>College</th>
    <th>Category</th>
    <th>Date</th>
    <th>Venue</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['event_title']; ?></td>

<td><?php echo $row['college_name']; ?></td>

<td><?php echo $row['category_name']; ?></td>

<td><?php echo $row['event_date']; ?></td>

<td><?php echo $row['venue']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>
<a class="btn"
href="event_details.php?id=<?php echo $row['event_id']; ?>">
View
</a>
</td>

</tr>

<?php

}

}
else{

echo "<tr>
<td colspan='7'>No registrations found.</td>
</tr>";

}

?>

</table>

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

$student_id = $_SESSION['student_id'];

// Fetch Student Registrations
$query = "
SELECT
    r.registration_id,
    r.status,
    r.registration_date,
    e.event_id,
    e.event_title,
    e.event_date,
    e.venue,
    c.category_name,
    col.college_name
FROM registrations r
INNER JOIN events e ON r.event_id = e.event_id
INNER JOIN categories c ON e.category_id = c.category_id
INNER JOIN colleges col ON e.college_id = col.college_id
WHERE r.student_id = '$student_id'
ORDER BY e.event_date ASC";

$result = mysqli_query($conn, $query);
?>
