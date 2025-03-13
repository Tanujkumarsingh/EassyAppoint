<?php
include '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $password = $_POST['password'];

    // Check authentication database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $auth_conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['reference_id'] = $user['reference_id'];

            if ($user['user_type'] == 'client') {
                header("Location: ../client_dashboard.php");
            } else {
                header("Location: ../company_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
