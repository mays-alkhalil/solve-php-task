<?php
include 'includes/db.php';

// الحصول على معرف المستخدم
$user_id = $_GET['id'];

// تنفيذ الحذف الناعم
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // إذا كانت القيمة confirm = yes من الرابط، نقوم بتنفيذ الحذف
    $stmt = $pdo->prepare("UPDATE users SET is_deleted = 1 WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // إعادة توجيه إلى صفحة لوحة التحكم بعد الحذف
    header('Location: users.php');
    exit();
}

// إذا لم يتم التأكيد على الحذف، يتم عرض نافذة تأكيد
?>
<script>
    var userConfirmed = confirm("هل أنت متأكد أنك تريد حذف هذا المستخدم؟");
    if (userConfirmed) {
        // إذا أكد المستخدم، نعيد تحميل الصفحة مع إضافة confirm=yes في الرابط لتنفيذ الحذف
        window.location.href = "delete_user.php?id=<?php echo $user_id; ?>&confirm=yes";
    } else {
        // إذا رفض المستخدم الحذف، نعيد التوجيه إلى صفحة لوحة التحكم
        window.location.href = "users.php";
    }
</script>
