<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit();
}

include('db.php');

$query = "SELECT * FROM users WHERE is_admin = 0"; // Only show non-admin users
$result = mysqli_query($conn, $query);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header('Location: manage_users.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? md5($_POST['password']) : null;

    $updateQuery = "UPDATE users SET name='$name', email='$email'";
    if ($password) {
        $updateQuery .= ", password='$password'";
    }
    $updateQuery .= " WHERE id=$id";
    mysqli_query($conn, $updateQuery);
    header('Location: manage_users.php');
}

if (isset($_GET['promote'])) {
    $id = $_GET['promote'];
    mysqli_query($conn, "UPDATE users SET is_admin=1 WHERE id=$id");
    header('Location: manage_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Users</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <form method="POST">
                            <td><?php echo $row['id']; ?></td>
                            <td><input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control"></td>
                            <td><input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control"></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                <a href="manage_users.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                <a href="manage_users.php?promote=<?php echo $row['id']; ?>" class="btn btn-warning">Promote to Admin</a>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="admin.php" class="btn btn-secondary">Back to Admin Dashboard</a>
    </div>
</body>
</html>
