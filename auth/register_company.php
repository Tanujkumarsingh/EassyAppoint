<?php
include '../config/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['Lastname'];
    $phone = $_POST['Phone'];
    $district = $_POST['District'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into company database
    $sql = "INSERT INTO companies (firstname, lastname, phone, district, email, password_hash) 
            VALUES ('$firstname', '$lastname', '$phone', '$district', '$email', '$password')";

    if ($company_conn->query($sql) === TRUE) {
        $company_id = $company_conn->insert_id;
        
        // Insert into auth_database
        $auth_sql = "INSERT INTO users (email, password_hash, user_type, reference_id) VALUES ('$email', '$password', 'company', '$company_id')";
        $auth_conn->query($auth_sql);

        echo "Company Registered Successfully!";
    } else {
        echo "Error: " . $company_conn->error;
    }
}
?>
