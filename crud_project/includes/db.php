<?php
$host = 'localhost';      // اسم السيرفر
$dbname = 'dashboard_db'; // اسم قاعدة البيانات
$username = 'root';       // اسم المستخدم
$password = '';           // كلمة السر (أو كلمة السر إذا كانت موجودة)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
