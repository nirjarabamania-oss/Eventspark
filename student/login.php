<?php
session_start();
include("../config/database.php");

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1)
    {
        $student = mysqli_fetch_assoc($result);

        if(password_verify($password, $student['password']))
        {
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['student_name'] = $student['full_name'];
            $_SESSION['student_email'] = $student['email'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            $error = "Invalid Email or Password!";
        }
    }
    else
    {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="../css/student.css">

    <style>
        body{
            margin:0;
            padding:0;
            font-family:Arial, sans-serif;
            background:#f4f4f4;
        }

        .login-container{
            width:400px;
            margin:80px auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:12px;
            margin:10px 0;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:12px;
            background:#007bff;
            color:#fff;
            border:none;
            cursor:pointer;
            font-size:16px;
            border-radius:5px;
        }

        button:hover{
            background:#0056b3;
        }

        .error{
            color:red;
            text-align:center;
            margin-bottom:15px;
        }

        .register{
            text-align:center;
            margin-top:15px;
        }
    </style>
</head>
<body>

<div class="login-container">

    <h2>Student Login</h2>

    <?php if(isset($error)){ ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

        <input type="email" name="email" placeholder="Enter Email" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <div class="register">
        Don't have an account?
        <a href="register.php">Register Here</a>
    </div>

</div>

</body>
</html>