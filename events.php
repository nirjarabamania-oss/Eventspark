<?php
session_start();
include("../config/database.php");

// Check login
if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch all active events
$query = "SELECT * FROM events WHERE status='Active' ORDER BY event_date ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Events</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            margin:0;
            padding:20px;
        }

        h2{
            text-align:center;
        }

        .container{
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            gap:20px;
        }

        .card{
            width:300px;
            background:white;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
            overflow:hidden;
        }

        .card img{
            width:100%;
            height:180px;
            object-fit:cover;
        }

        .card-body{
            padding:15px;
        }

        .card-body h3{
            margin:0;
            color:#333;
        }

        .card-body p{
            margin:8px 0;
            color:#555;
        }

        .btn{
            display:inline-block;
            padding:10px 15px;
            background:#007bff;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .btn:hover{
            background:#0056b3;
        }

        .back{
            margin-bottom:20px;
        }
    </style>

</head>

<body>

<a href="dashboard.php" class="btn back">← Dashboard</a>

<h2>Available Events</h2>

<div class="container">

<?php
if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
?>

<div class="card">

    <img src="../uploads/<?php echo $row['poster']; ?>" alt="Event Poster">

    <div class="card-body">

        <h3><?php echo $row['title']; ?></h3>

        <p><strong>Category:</strong> <?php echo $row['category']; ?></p>

        <p><strong>Date:</strong> <?php echo $row['event_date']; ?></p>

        <p><strong>Venue:</strong> <?php echo $row['venue']; ?></p>

        <a class="btn" href="event_details.php?id=<?php echo $row['event_id']; ?>">
            View Details
        </a>

    </div>

</div>

<?php
    }
}
else
{
    echo "<h3>No Events Available</h3>";
}
?>

</div>

</body>
</html>