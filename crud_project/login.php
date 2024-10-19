<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // تحقق من بيانات المستخدم
    $sql = "SELECT * FROM users WHERE user_email = :user_email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_email', $user_email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($user_password, $user['user_password'])) {
        // تخزين معلومات الجلسة للمستخدم
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: landing_page.php');
    } else {
        echo "Invalid credentials!";
    }
}
?>

<form method="POST" action="">
    <label for="user_email">Email:</label>
    <input type="email" name="user_email" id="user_email" required>
    <label for="user_password">Password:</label>
    <input type="password" name="user_password" id="user_password" required>
    <button type="submit">Login</button>
</form>
