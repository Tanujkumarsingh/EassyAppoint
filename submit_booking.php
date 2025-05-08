<?php
session_start();
require_once "config/db_connect.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

$user_email = $_SESSION['user_email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST['company'], $_POST['service_name'], $_POST['appointment_date'], $_POST['appointment_time'])) {

    $company          = $_POST['company'];
    $service_name     = $_POST['service_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status           = "Pending";

    $sql = "INSERT INTO bookings 
            (user_email, company_email, service_name, appointment_date, appointment_time, status) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn_views->prepare($sql);  // ← use $conn_views

    if (!$stmt) {
        die("Prepare failed: " . $conn_views->error);
    }

    $stmt->bind_param("ssssss", $user_email, $company, $service_name, $appointment_date, $appointment_time, $status);

    if ($stmt->execute()) {
        header("Location: my_bookings.php");
        exit();
    } else {
        echo "Booking failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid input.";
}
?>
