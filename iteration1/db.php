<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'user_system';

$conn = mysqli_connect($host, $user, $password, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Store the user ID in the session for use in other files
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = null;
}
?>
