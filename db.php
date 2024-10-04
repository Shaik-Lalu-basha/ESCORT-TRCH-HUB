<?php
// Database credentials
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "escort_tech_hub"; // Your database name

// Enable MySQLi error reporting (optional but recommended)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Set character set to UTF-8 (important for handling special characters)
    $conn->set_charset("utf8");

    // If connected successfully
    // echo "Database connection successful"; // Optionally, you can leave this commented out.
    
} catch (mysqli_sql_exception $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>
