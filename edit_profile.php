<?php
session_start();
require_once "config/db_connect.php"; // Adjust path if needed

// Check if user is logged in
if (!isset($_SESSION['client_id'])) {
    die("Access denied. Please log in.");
}

$client_id = $_SESSION['client_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];

    $stmt = $conn->prepare("UPDATE clients SET firstname = ?, lastname = ?, phone = ?, email = ? WHERE client_id = ?");
    $stmt->bind_param("ssssi", $firstname, $lastname, $phone, $email, $client_id);

    if ($stmt->execute()) {
        $success_message = "Profile updated successfully.";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch current data
$stmt = $conn->prepare("SELECT firstname, lastname, phone, email FROM clients WHERE client_id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
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
