<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $user_address = $_POST['user_address'];

    // إضافة المستخدم إلى قاعدة البيانات
    $sql = "INSERT INTO users (user_name, user_email, user_mobile, user_address) VALUES (:user_name, :user_email, :user_mobile, :user_address)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_name' => $user_name,
        'user_email' => $user_email,
        'user_mobile' => $user_mobile,
        'user_address' => $user_address
    ]);

    // إعادة التوجيه بعد التسجيل
    header('Location: login.php');
}
?>

<form method="POST" action="">
    <label for="user_name">Name:</label>
    <input type="text" name="user_name" id="user_name" required>
    <label for="user_email">Email:</label>
    <input type="email" name="user_email" id="user_email" required>
    <label for="user_mobile">Mobile:</label>
    <input type="text" name="user_mobile" id="user_mobile" required>
    <label for="user_address">Address:</label>
    <input type="text" name="user_address" id="user_address" required>
    <button type="submit">Sign Up</button>
</form>
