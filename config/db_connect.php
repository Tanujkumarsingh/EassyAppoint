<?php
$servername = "localhost";
$username = "root";  // Default XAMPP user
$password = "";  // No password by default
$dbname_client = "client_database";
$dbname_company = "company_database";
$dbname_auth = "auth_database";
$dbname_ads = "company_data";
$dbname = "company_data";
$View_bookAd = "booking";

// Create connections
$client_conn = new mysqli($servername, $username, $password, $dbname_client);
$company_conn = new mysqli($servername, $username, $password, $dbname_company);
$auth_conn = new mysqli($servername, $username, $password, $dbname_auth);
$ads_conn = new mysqli($servername, $username, $password, $dbname_ads);
$conn = new mysqli($servername, $username, $password, $dbname);
$conn_view = new mysqli($servername, $username, $password, $dbname);
$conn_views = new mysqli($servername, $username, $password, $View_bookAd);

// Check connections
if ($client_conn->connect_error || $company_conn->connect_error || $auth_conn->connect_error || $ads_conn->connect_error || $conn->connect_error || $conn_view->connect_error || $conn_views->connect_error) {
    die("Connection failed: " . $client_conn->connect_error . " / " . $company_conn->connect_error . " / " . $auth_conn->connect_error . " / " . $ads_conn->connect_error . " / " . $conn->connect_error  . " / " . $conn_view->connect_error . " / " . $conn_views->connect_error);
}
