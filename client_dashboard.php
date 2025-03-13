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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2>Welcome, Client</h2>
        <a href="logout.php">Logout</a>
    </header>

    <div class="container">
        <h1>Client Dashboard</h1>
        <p>Email: <?php echo $_SESSION['email']; ?></p>
        <p>Here you can book appointments and manage your profile.</p>
    </div>
</body>
</html>
