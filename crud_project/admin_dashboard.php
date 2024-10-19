<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="users.php"><span class="material-icons">person</span> Users</a></li>
                <li><a href="orders.php"><span class="material-icons">shopping_cart</span> Orders</a></li>
                <li><a href="items.php"><span class="material-icons">inventory</span> Items</a></li>
            </ul>
        </div>

    
        <?php
include 'includes/db.php';


$user_count = $pdo->query("SELECT COUNT(*) FROM users WHERE is_deleted = 0")->fetchColumn();
$order_count = $pdo->query("SELECT COUNT(*) FROM orders WHERE is_deleted = 0")->fetchColumn();
$item_count = $pdo->query("SELECT COUNT(*) FROM items WHERE is_deleted = 0")->fetchColumn();
?>
      <div class="content">
    <h2>Dashboard Overview</h2>
    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <p><?php echo $user_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p><?php echo $order_count; ?></p>
        </div>
        <div class="card">
            <h3>Total Items</h3>
            <p><?php echo $item_count; ?></p>
        </div>
    </div>
</div>


    </div>
</body>
</html>
