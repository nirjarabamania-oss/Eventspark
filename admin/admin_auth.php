 <?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /eventspark/Eventspark/admin/login.php");
    exit();
}
?>