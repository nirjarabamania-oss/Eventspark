<?php
session_start();
include "config/database.php";

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($sql) == 1)
    {
        $user = mysqli_fetch_assoc($sql);

        if(password_verify($password,$user['password']))
        {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            header("Location: student/dashboard.php");
            exit();
        }
        else
        {
            $message = "Invalid Password";
        }
    }
    else
    {
        $message = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>
<body>

<h2>Student Login</h2>

<p style="color:red;">
<?php echo $message; ?>
</p>

<form method="POST">

<label>Email</label><br>
<input type="email" name="email"><br><br>

<label>Password</label><br>
<input type="password" name="password"><br><br>

<button type="submit" name="login">Login</button>

</form>

<p>
Don't have an account?
<a href="register.php">Register</a>
</p>

</body>
</html>