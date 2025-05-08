<?php
session_start();
require_once "config/db_connect.php";

if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'client') {
    header("Location: index.php");
    exit();
}

// Handle search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT id, company_email, service_name, price, description, image_path FROM ads";
if ($search !== '') {
    $safeSearch = $conn->real_escape_string($search);
    $sql .= " WHERE service_name LIKE '%$safeSearch%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyAppoint</title>

    <link rel="stylesheet" href="navbar.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
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

    <h2 style="text-align:center;">Available Services</h2>

    <!-- Search Form -->
    <form method="GET" style="text-align:center; margin: 20px auto;">
        <input
            type="text"
            name="search"
            placeholder="Search for a service..."
            value="<?= htmlspecialchars($search) ?>"
            style="padding: 8px 12px; width: 250px; border: 1px solid #ccc; border-radius: 6px;" />
        <button
            type="submit"
            style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer;">
            Search
        </button>
    </form>

    <!-- Ads List -->
    <div class="ad-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="ad-item">
                    <?php if (!empty($row['image_path'])): ?>
                        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Ad Image">
                    <?php endif; ?>

                    <div class="ad-content">
                        <h3><?= htmlspecialchars($row['service_name']) ?></h3>
                        <p><strong>Price:</strong> ₹<?= htmlspecialchars($row['price']) ?></p>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                        <p><strong>Company:</strong> <?= htmlspecialchars($row['company_email']) ?></p>

                        <form class="booking-form" action="submit_booking.php" method="POST">
                            <input type="hidden" name="company" value="<?= htmlspecialchars($row['company_email']) ?>">
                            <input type="hidden" name="service_name" value="<?= htmlspecialchars($row['service_name']) ?>">

                            <button type="button" onclick="showDateTime(this)">Book This Appointment</button>

                            <!-- Initially hidden date-time fields -->
                            <div class="date-time-fields" style="display: none; margin-top: 10px;">
                                <!-- <label for="appointment_date">Date:</label> -->
                                <input type="date" name="appointment_date" required><br>

                                <!-- <label for="appointment_time">Time:</label> -->
                                <input type="time" name="appointment_time" placeholder="Time" required><br><br>

                                <button type="submit">Confirm Booking</button>
                            </div>
                        </form>



                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">No services found for "<strong><?= htmlspecialchars($search) ?></strong>".</p>
        <?php endif; ?>
    </div>
    <script>
function showDateTime(button) {
    const form = button.closest('.booking-form');  // Find the closest form
    const dateTimeFields = form.querySelector('.date-time-fields'); // Get the hidden date-time fields

    // Toggle visibility of the date-time fields
    if (dateTimeFields.style.display === 'none' || dateTimeFields.style.display === '') {
        dateTimeFields.style.display = 'block'; // Show the fields
    } else {
        dateTimeFields.style.display = 'none'; // Hide the fields (in case the user clicks again)
    }
}
</script>


</body>

</html>