<?php
session_start();
include("../config/database.php");

// Check Login
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Update Profile
if(isset($_POST['update']))
{
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);
    $year = mysqli_real_escape_string($conn,$_POST['year']);

    // Profile Photo Upload
    if(!empty($_FILES['profile_photo']['name']))
    {
        $photo = time()."_".$_FILES['profile_photo']['name'];
        $target = "../uploads/profile/".$photo;

        move_uploaded_file($_FILES['profile_photo']['tmp_name'],$target);

        mysqli_query($conn,"
        UPDATE students
        SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        course='$course',
        year='$year',
        profile_photo='$photo'
        WHERE student_id='$student_id'
        ");
    }
    else
    {
        mysqli_query($conn,"
        UPDATE students
        SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        course='$course',
        year='$year'
        WHERE student_id='$student_id'
        ");
    }

    echo "<script>
    alert('Profile Updated Successfully');
    window.location='profile.php';
    </script>";
}

// Fetch Student Details
$result = mysqli_query($conn,"
SELECT * FROM students
WHERE student_id='$student_id'
");

$student = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>

<head>

<title>My Profile</title>

<link rel="stylesheet" href="../css/student.css">

<style>

.container{
    width:600px;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}

input,select{

width:100%;
padding:10px;
margin:8px 0;

}

img{

width:120px;
height:120px;
border-radius:50%;
object-fit:cover;

}

button{

background:#007BFF;
color:white;
padding:10px 20px;
border:none;
cursor:pointer;

}

</style>

</head>

<body>

<div class="container">

<h2>My Profile</h2>

<center>

<?php

if(!empty($student['profile_photo']))
{

?>

<img src="../uploads/profile/<?php echo $student['profile_photo']; ?>">

<?php
}
?>

</center>

<form method="POST" enctype="multipart/form-data">

<label>Full Name</label>

<input
type="text"
name="full_name"
value="<?php echo $student['full_name']; ?>"
required>

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo $student['email']; ?>"
required>

<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo $student['phone']; ?>">

<label>Course</label>

<input
type="text"
name="course"
value="<?php echo $student['course']; ?>">

<label>Year</label>

<input
type="text"
name="year"
value="<?php echo $student['year']; ?>">

<label>Profile Photo</label>

<input
type="file"
name="profile_photo">

<br><br>

<button name="update">
Update Profile
</button>

</form>

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

// Update Profile
if(isset($_POST['update']))
{
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $course = mysqli_real_escape_string($conn,$_POST['course']);
    $year = mysqli_real_escape_string($conn,$_POST['year']);

    // Profile Photo Upload
    if(!empty($_FILES['profile_photo']['name']))
    {
        $photo = time()."_".$_FILES['profile_photo']['name'];
        $target = "../uploads/profile/".$photo;

        move_uploaded_file($_FILES['profile_photo']['tmp_name'],$target);

        mysqli_query($conn,"
        UPDATE students
        SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        course='$course',
        year='$year',
        profile_photo='$photo'
        WHERE student_id='$student_id'
        ");
    }
    else
    {
        mysqli_query($conn,"
        UPDATE students
        SET
        full_name='$full_name',
        email='$email',
        phone='$phone',
        course='$course',
        year='$year'
        WHERE student_id='$student_id'
        ");
    }

    echo "<script>
    alert('Profile Updated Successfully');
    window.location='profile.php';
    </script>";
}

// Fetch Student Details
$result = mysqli_query($conn,"
SELECT * FROM students
WHERE student_id='$student_id'
");

$student = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>

<head>

<title>My Profile</title>

<link rel="stylesheet" href="../css/student.css">

<style>

.container{
    width:600px;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px #ccc;
}

input,select{

width:100%;
padding:10px;
margin:8px 0;

}

img{

width:120px;
height:120px;
border-radius:50%;
object-fit:cover;

}

button{

background:#007BFF;
color:white;
padding:10px 20px;
border:none;
cursor:pointer;

}

</style>

</head>

<body>

<div class="container">

<h2>My Profile</h2>

<center>

<?php

if(!empty($student['profile_photo']))
{

?>

<img src="../uploads/profile/<?php echo $student['profile_photo']; ?>">

<?php
}
?>

</center>

<form method="POST" enctype="multipart/form-data">

<label>Full Name</label>

<input
type="text"
name="full_name"
value="<?php echo $student['full_name']; ?>"
required>

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo $student['email']; ?>"
required>

<label>Phone</label>

<input
type="text"
name="phone"
value="<?php echo $student['phone']; ?>">

<label>Course</label>

<input
type="text"
name="course"
value="<?php echo $student['course']; ?>">

<label>Year</label>

<input
type="text"
name="year"
value="<?php echo $student['year']; ?>">

<label>Profile Photo</label>

<input
type="file"
name="profile_photo">

<br><br>

<button name="update">
Update Profile
</button>

</form>

</div>

</body>

</html>
