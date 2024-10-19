<?php
include 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM users WHERE is_deleted = 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="content">
        <a href="create_user.php" class="btn-create">Create New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['user_mobile']}</td>
                            <td>{$row['user_email']}</td>
                            <td>{$row['user_address']}</td>
                            <td>
                                <a href='update_user.php?id={$row['user_id']}'>Edit</a>
                                <a href='delete_user.php?id={$row['user_id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
