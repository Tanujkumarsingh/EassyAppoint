<?php
include '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['Lastname'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into client database
    $sql = "INSERT INTO clients (firstname, lastname, phone, email, password_hash) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password')";

    if ($client_conn->query($sql) === TRUE) {
        $client_id = $client_conn->insert_id;
        
        // Insert into auth_database
        $auth_sql = "INSERT INTO users (email, password_hash, user_type, reference_id) VALUES ('$email', '$password', 'client', '$client_id')";
        $auth_conn->query($auth_sql);

        echo "Client Registered Successfully!";
    } else {
        echo "Error: " . $client_conn->error;
    }
}
?>
