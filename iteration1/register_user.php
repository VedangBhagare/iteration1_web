<?php
include('db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
if (mysqli_query($conn, $query)) {
    echo "User registered successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
