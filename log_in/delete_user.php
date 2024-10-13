<?php
session_start();
include 'db_connection.php'; 

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit(); 
?>
