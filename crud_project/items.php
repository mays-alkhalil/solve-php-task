<?php
include 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM items WHERE is_deleted = 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    </div>
    <div class="content">
        <a href="create_item.php" class="btn-create">Create New Item</a>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Total Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['item_id']}</td>
                            <td>{$row['item_description']}</td>
                            <td><img src='uploads/{$row['item_image']}' alt='Image' width='100'></td>
                            <td>{$row['item_total_number']}</td>
                            <td>
                                <a href='update_item.php?id={$row['item_id']}'>Edit</a>
                                <a href='delete_item.php?id={$row['item_id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>