<?php
session_start();
require_once "config/db_connect.php";

if (!isset($_SESSION['user_email'])) {
    echo "User not logged in.";
    exit;
}

$user_email = $_SESSION['user_email'];

$sql = "SELECT company_email, service_name, appointment_date, appointment_time, status FROM bookings WHERE user_email = ?";
$stmt = $conn_views->prepare($sql); // ← updated

if (!$stmt) {
    die("Prepare failed: " . $conn_views->error);
}

$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>
