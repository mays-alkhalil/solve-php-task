<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'my_database'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!-- new PDO(...) يقوم بإنشاء كائن PDO جديد. هنا، يتم تحديد تفاصيل الاتصال بقاعدة البيانات، حيث:
mysql:host=$host تحدد نوع قاعدة البيانات (MySQL) ومضيفها.
dbname=$dbname تحدد اسم قاعدة البيانات التي نريد الاتصال بها.
setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); تُستخدم لضبط وضع معالجة الأخطاء.
PDO::ATTR_ERRMODE هو سمة تُحدد كيفية التعامل مع الأخطاء.
PDO::ERRMODE_EXCEPTION يعني أن PDO سيقوم بإطلاق استثناء (Exception) عندما يحدث خطأ، مما يمكن المطور من التعامل معه بشكل أفضل. -->
