<?php
include 'includes/db.php';

// الحصول على معرف العنصر
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // تنفيذ الحذف الناعم إذا تم التأكيد
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // إذا كانت القيمة confirm=yes من الرابط، نقوم بتنفيذ الحذف
        $stmt = $pdo->prepare("UPDATE items SET is_deleted = 1 WHERE item_id = ?");
        $stmt->execute([$item_id]);

        // إعادة توجيه إلى صفحة لوحة التحكم بعد الحذف
        header('Location: items.php');
        exit();
    }
} else {
    header('Location: admin_dashboard.php');
    exit();
}
?>

<script>
    var userConfirmed = confirm("هل أنت متأكد أنك تريد حذف هذا العنصر؟");
    if (userConfirmed) {
        // إذا أكد المستخدم، نعيد تحميل الصفحة مع إضافة confirm=yes في الرابط لتنفيذ الحذف
        window.location.href = "delete_item.php?id=<?php echo $item_id; ?>&confirm=yes";
    } else {
        // إذا رفض المستخدم الحذف، نعيد التوجيه إلى صفحة لوحة التحكم
        window.location.href = "items.php";
    }
</script>
