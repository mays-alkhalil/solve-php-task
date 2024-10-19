<?php
include 'includes/db.php';

// استعلام لجلب العناصر في السلة
$user_id = 1; // يجب أن يتم تحديد معرف المستخدم من الجلسة أو من خلال تسجيل الدخول
$sql = "SELECT shopping_cart.cart_id, items.item_description, items.item_image, shopping_cart.quantity
        FROM shopping_cart
        JOIN items ON shopping_cart.item_id = items.item_id
        WHERE shopping_cart.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <div>
        <?php foreach ($cart_items as $item): ?>
            <div>
                <img src="<?= $item['item_image']; ?>" alt="<?= $item['item_description']; ?>" width="100">
                <p><?= $item['item_description']; ?></p>
                <p>Quantity: <?= $item['quantity']; ?></p>
                <a href="remove_from_cart.php?id=<?= $item['cart_id']; ?>">Remove</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
