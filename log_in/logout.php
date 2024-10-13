<?php
session_start();
session_destroy();
header("Location: login.php");
// هي دالة PHP تُستخدم لإرسال عنوان HTTP (HTTP header) إلى المتصفح. 
exit();
?>
