<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <div class="mt-4">
            <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
            <a href="manage_admins.php" class="btn btn-warning">Manage Admins</a>
        </div>
        <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
    </div>
</body>
</html>
