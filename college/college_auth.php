<?php
session_start();

if (!isset($_SESSION['college_id'])) {
    header("Location: login.php");
    exit();
}
?>