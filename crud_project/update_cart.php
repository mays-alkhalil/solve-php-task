<?php
include 'includes/db.php';

if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // تحديث الكمية
    $sql = "UPDATE shopping_cart SET quantity = :quantity WHERE cart_id = :cart_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
    $stmt->execute();

    // إعادة التوجيه إلى صفحة السلة
    header('Location: shopping_cart.php');
}
