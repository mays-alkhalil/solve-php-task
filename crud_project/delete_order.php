<?php
include 'includes/db.php';

// الحصول على معرف الطلب
$order_id = $_GET['id'];

// تنفيذ الحذف الناعم إذا تم التأكيد
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // إذا كانت القيمة confirm=yes من الرابط، نقوم بتنفيذ الحذف
    $stmt = $pdo->prepare("UPDATE orders SET is_deleted = 1 WHERE order_id = ?");
    $stmt->execute([$order_id]);

    // إعادة توجيه إلى صفحة لوحة التحكم بعد الحذف
    header('Location:orders.php');
    exit();
}

// إذا لم يتم التأكيد على الحذف، يتم عرض نافذة تأكيد
?>
<script>
    var userConfirmed = confirm("هل أنت متأكد أنك تريد حذف هذا الطلب؟");
    if (userConfirmed) {
        // إذا أكد المستخدم، نعيد تحميل الصفحة مع إضافة confirm=yes في الرابط لتنفيذ الحذف
        window.location.href = "delete_order.php?id=<?php echo $order_id; ?>&confirm=yes";
    } else {
        // إذا رفض المستخدم الحذف، نعيد التوجيه إلى صفحة لوحة التحكم
        window.location.href = "orders.php";
    }
</script>
