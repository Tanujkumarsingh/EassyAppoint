<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'client') {
    header("Location: index.php");
    exit();
}

require_once 'config/db_connect.php';

$user_email = $_SESSION['email'];

// Get client_id based on logged-in email
$stmt = $client_conn->prepare("SELECT client_id FROM clients WHERE email = ?");
if (!$stmt) {
    die("Prepare failed: " . $client_conn->error);
}
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Client not found.");
}
$row = $result->fetch_assoc();
$client_id = $row['client_id'];
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];

    $stmt = $client_conn->prepare("UPDATE clients SET firstname = ?, lastname = ?, phone = ?, email = ? WHERE client_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $client_conn->error);
    }
    $stmt->bind_param("ssssi", $firstname, $lastname, $phone, $email, $client_id);

    if ($stmt->execute()) {
        $success_message = "Profile updated successfully.";
        $_SESSION['email'] = $email; // Update session email if changed
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch current data
$stmt = $client_conn->prepare("SELECT firstname, lastname, phone, email FROM clients WHERE client_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $client_conn->error);
}
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EasyAppoint</title>

    <link rel="stylesheet" href="navbar.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
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
    <h2>Edit Your Profile</h2>

    <?php if (isset($success_message)) echo "<p style='color: green;'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>

    <form method="post">
        <label>First Name:</label><br>
        <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <button type="submit">Update Profile</button>
    </form>
</body>

</html>
