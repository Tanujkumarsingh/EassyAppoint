<?php
$servername = "localhost";
$username = "root";  // Default XAMPP user
$password = "";  // No password by default
$dbname_client = "client_database";
$dbname_company = "company_database";
$dbname_auth = "auth_database";
$dbname_ads = "client_data";

// Create connections
$client_conn = new mysqli($servername, $username, $password, $dbname_client);
$company_conn = new mysqli($servername, $username, $password, $dbname_company);
$auth_conn = new mysqli($servername, $username, $password, $dbname_auth);
$ads_conn = new mysqli($servername , $username , $password , $dbname_ads);

// Check connections
if ($client_conn->connect_error || $company_conn->connect_error || $auth_conn->connect_error) {
    die("Connection failed: " . $client_conn->connect_error . " / " . $company_conn->connect_error . " / " . $auth_conn->connect_error);
}
?>
