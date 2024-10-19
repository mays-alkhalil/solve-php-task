<?php
include 'includes/db.php';

// الحصول على معرف الطلب من الرابط
$order_id = $_GET['id'];

// جلب بيانات الطلب الحالي من قاعدة البيانات
$stmt = $pdo->prepare("
    SELECT orders.order_id, users.user_id, users.user_name, items.item_id, items.item_description 
    FROM orders 
    JOIN users ON orders.user_order_id = users.user_id 
    JOIN items ON orders.user_item_order_id = items.item_id 
    WHERE orders.order_id = ?
");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// التحقق مما إذا تم إرسال النموذج للتعديل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_order_id = $_POST['user_order_id'];
    $user_item_order_id = $_POST['user_item_order_id'];

    // تحديث بيانات الطلب في قاعدة البيانات
    $stmt = $pdo->prepare("UPDATE orders SET user_order_id = ?, user_item_order_id = ? WHERE order_id = ?");
    $stmt->execute([$user_order_id, $user_item_order_id, $order_id]);

    // إعادة توجيه إلى صفحة لوحة التحكم
    header('Location:orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Update Order</h1>
    <form method="POST" action="update_order.php?id=<?= $order_id ?>">
        <label for="user_order_id">User:</label>
        <select id="user_order_id" name="user_order_id" required>
            <?php
            // عرض جميع المستخدمين في قائمة منسدلة
            $users_stmt = $pdo->query("SELECT user_id, user_name FROM users WHERE is_deleted = 0");
            while ($user = $users_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$user['user_id']}'" . ($user['user_id'] == $order['user_id'] ? ' selected' : '') . ">{$user['user_name']}</option>";
            }
            ?>
        </select>

        <label for="user_item_order_id">Item:</label>
        <select id="user_item_order_id" name="user_item_order_id" required>
            <?php
            // عرض جميع العناصر في قائمة منسدلة
            $items_stmt = $pdo->query("SELECT item_id, item_description FROM items WHERE is_deleted = 0");
            while ($item = $items_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$item['item_id']}'" . ($item['item_id'] == $order['item_id'] ? ' selected' : '') . ">{$item['item_description']}</option>";
            }
            ?>
        </select>

        <button type="submit">Update Order</button>
    </form>
</body>
</html>
