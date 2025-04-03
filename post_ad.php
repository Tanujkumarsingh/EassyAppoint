<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'company') {
    header("Location: index.php");
    exit();
}

// Database connection
$servername = "localhost"; // Change if needed
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "client_data"; // Change to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_email = $_SESSION['email']; // Get logged-in company email
    $service_name = mysqli_real_escape_string($conn, $_POST['ServiceName']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);

    // Handle image upload
    $image_path = "";
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file type
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Error uploading image.";
                exit();
            }
        } else {
            echo "Invalid image format. Only JPG, JPEG, PNG & GIF allowed.";
            exit();
        }
    }

    // Insert into database
    $sql = "INSERT INTO ads (company_email, service_name, price, description, image_path) 
            VALUES ('$company_email', '$service_name', '$price', '$description', '$image_path')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ad posted successfully!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
