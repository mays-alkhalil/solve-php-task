<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div class="container">
        <h2>Users</h2>
        
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
                include 'includes/db.php';
                $stmt = $pdo->query("SELECT * FROM users WHERE is_deleted = 0");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['user_mobile']}</td>
                            <td>{$row['user_email']}</td>
                            <td>{$row['user_address']}</td>
                            <td>
                                <a href='update.php?id={$row['user_id']}'>Edit</a>
                                <a href='delete.php?id={$row['user_id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
