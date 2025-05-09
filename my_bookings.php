<?php
session_start();

// Redirect if not logged in or not a client
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'client') {
    header("Location: index.php");
    exit();
}

// Connect to DB
require_once 'config/db_connect.php';

// Get client email from session
$client_email = $_SESSION['email'];

// Prepare and execute SQL query
$sql = "SELECT company_email, service_name, appointment_date, appointment_time, status FROM bookings WHERE user_email = ?";
$stmt = $conn_views->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn_views->error);
}

$stmt->bind_param("s", $client_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyAppoint</title>

    <link rel="stylesheet" href="navbar.css" />
    <link rel="stylesheet" href="my_booking.css">
    <link rel="stylesheet" href="edit_profile.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Header  -->
    <header>
        <div class="navbar">
            <div class="navbar-logo">
                <img src="logo.png" alt="EasyAppoint" />
            </div>
            <a href="book_appointment.php">Book Appointment</a>
            <a href="my_bookings.php">My Bookings</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <h2>My Bookings</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Company Email</th>
                    <th>Service</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['company_email']) ?></td>
                        <td><?= htmlspecialchars($row['service_name']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_time']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-bookings">You have no bookings yet.</p>
    <?php endif; ?>

</body>
</html>
