<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];

    // حذف العنصر من السلة
    $sql = "DELETE FROM shopping_cart WHERE cart_id = :cart_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
    $stmt->execute();

    // إعادة التوجيه إلى صفحة السلة
    header('Location: shopping_cart.php');
}
