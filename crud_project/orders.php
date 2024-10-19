<?php
include 'includes/db.php';

$stmt = $pdo->query("
    SELECT orders.order_id, users.user_name, items.item_description 
    FROM orders 
    JOIN users ON orders.user_order_id = users.user_id
    JOIN items ON orders.user_item_order_id = items.item_id
    WHERE orders.is_deleted = 0
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    </div>
    <div class="content">
        <a href="create_order.php" class="btn-create">Create New Order</a>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Item Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['order_id']}</td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['item_description']}</td>
                            <td>
                                <a href='update_order.php?id={$row['order_id']}'>Edit</a>
                                <a href='delete_order.php?id={$row['order_id']}'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>