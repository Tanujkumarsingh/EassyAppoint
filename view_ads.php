<?php
session_start();
include 'config/db_connect.php'; // Ensure database connection

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "<p class='error'>You need to log in to view ads.</p>";
    exit;
}

$company_email = $_SESSION['email']; // Get logged-in company's email

$sql = "SELECT * FROM ads WHERE company_email = ? ORDER BY created_at DESC";
$stmt = $ads_conn->prepare($sql);
$stmt->bind_param("s", $company_email);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ads</title>
    <link rel="stylesheet" href="navbar.css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <style>
        h1 {
            text-align: center;
            color: #333;
        }

        .ads-container {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 20px;
        }

        .ad {
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .ad img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .ad-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .ad h2 {
            margin: 0;
            color: #333;
        }

        .ad p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Header  -->
    <header>
        <div class="navbar">
            <div class="navbar-logo">
                <img src="logo.png" alt="EasyAppoint" style="height:40px;">
            </div>
            <a href="index.php">Dashboard</a>
            <a href="company_dashboard.php">Post Ad</a>
            <a href="view_ads.php">Ads</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <h1>My Ads</h1>

        <div class="ads-container">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="ad">
                    <?php if (!empty($row['image_path'])) { ?>
                        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Ad Image">
                    <?php } ?>
                    <div class="ad-details">
                        <h2><?= htmlspecialchars($row['service_name']) ?></h2>
                        <p><strong>Price:</strong> Rs. <?= htmlspecialchars($row['price']) ?></p>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>

<?php
$stmt->close();
$ads_conn->close();
?>