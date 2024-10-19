<?php
include 'includes/db.php';

// الحصول على تفاصيل العنصر والسلة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = 1; // يجب أن يتم تحديد معرف المستخدم من الجلسة أو من خلال تسجيل الدخول
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    // تحقق إذا كان العنصر موجودًا في السلة بالفعل
    $sql = "SELECT * FROM shopping_cart WHERE user_id = :user_id AND item_id = :item_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmt->execute();
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // إذا كان العنصر موجودًا في السلة، قم بتحديث الكمية
        $new_quantity = $cart_item['quantity'] + $quantity;
        $sql = "UPDATE shopping_cart SET quantity = :quantity WHERE cart_id = :cart_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_item['cart_id'], PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // إذا لم يكن موجودًا، أضفه إلى السلة
        $sql = "INSERT INTO shopping_cart (user_id, item_id, quantity) VALUES (:user_id, :item_id, :quantity)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'item_id' => $item_id, 'quantity' => $quantity]);
    }

    // إعادة التوجيه إلى السلة أو الصفحة التي تريدها
    header('Location: shopping_cart.php');
}
