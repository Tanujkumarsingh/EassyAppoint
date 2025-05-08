<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'client') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyAppoint</title>

    <link rel="stylesheet" href="navbar.css" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
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
</body>

</html>
