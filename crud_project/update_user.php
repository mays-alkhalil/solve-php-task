<?php
include 'includes/db.php';

// الحصول على معرف المستخدم من الرابط
$user_id = $_GET['id'];

// جلب بيانات المستخدم الحالي
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// التحقق مما إذا تم إرسال النموذج للتعديل
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $user_mobile = $_POST['user_mobile'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];

    // تحديث بيانات المستخدم في قاعدة البيانات
    $stmt = $pdo->prepare("UPDATE users SET user_name = ?, user_mobile = ?, user_email = ?, user_address = ? WHERE user_id = ?");
    $stmt->execute([$user_name, $user_mobile, $user_email, $user_address, $user_id]);

    // إعادة توجيه إلى صفحة لوحة التحكم
    header('Location: users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Update User</h1>
    <form method="POST" action="update_user.php?id=<?= $user_id ?>">
        <label for="user_name">Name:</label>
        <input type="text" id="user_name" name="user_name" value="<?= $user['user_name'] ?>" required>
        
        <label for="user_mobile">Mobile:</label>
        <input type="text" id="user_mobile" name="user_mobile" value="<?= $user['user_mobile'] ?>" required>
        
        <label for="user_email">Email:</label>
        <input type="email" id="user_email" name="user_email" value="<?= $user['user_email'] ?>" required>
        
        <label for="user_address">Address:</label>
        <input type="text" id="user_address" name="user_address" value="<?= $user['user_address'] ?>" required>
        
        <button type="submit">Update User</button>
    </form>
</body>
</html>
