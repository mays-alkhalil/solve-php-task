<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_order_id'];
    $item_id = $_POST['user_item_order_id'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_order_id, user_item_order_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $item_id]);

    header('Location: orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Add New Order</h1>
    <form method="POST" action="create_order.php">
        <label for="user_order_id">Select User:</label>
        <select id="user_order_id" name="user_order_id" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM users WHERE is_deleted = 0");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['user_id']}'>{$row['user_name']}</option>";
            }
            ?>
        </select>
        
        <label for="user_item_order_id">Select Item:</label>
        <select id="user_item_order_id" name="user_item_order_id" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM items WHERE is_deleted = 0");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['item_id']}'>{$row['item_description']}</option>";
            }
            ?>
        </select>
        
        <button type="submit">Add Order</button>
    </form>
</body>
</html>
