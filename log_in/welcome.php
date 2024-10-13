<?php
session_start();

// تأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// الحصول على معلومات المستخدم من الجلسة
$user = $_SESSION['user'];
$isAdmin = $user['role'] === 'admin'; // التحقق من دور المستخدم
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($user['fname']) . ' ' . htmlspecialchars($user['family_name']); ?></h2>
        <p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>

        <?php if ($isAdmin): ?>
            <a href="admin_dashboard.php" class="btn btn-primary">Go to Admin Dashboard</a>
        <?php else: ?>
            <p>You are logged in as a regular user.</p>
        <?php endif; ?>
        
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>
