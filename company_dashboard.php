<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'company') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2>Welcome, Company</h2>
        <a href="logout.php">Logout</a>
    </header>

    <div class="container">
        <h1>Company Dashboard</h1>
        <p>Email: <?php echo $_SESSION['email']; ?></p>
        <p>Here you can manage appointments and view client requests.</p>
    </div>
</body>
</html>
