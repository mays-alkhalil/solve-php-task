<?php
session_start();
include('db_connection.php');

// التحقق من وجود جلسة أو كوكي
if (!isset($_SESSION['user']) && isset($_COOKIE['user_id'])) {
    // إذا كانت الكوكي موجودة، جلب معلومات المستخدم من قاعدة البيانات بناءً على معرف المستخدم المخزن في الكوكي
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_COOKIE['user_id']]);
    $user = $stmt->fetch();

    // إذا تم العثور على المستخدم، إنشاء الجلسة بناءً على البيانات
    if ($user) {
        $_SESSION['user'] = $user;
    }
}

// إذا لم يكن هناك جلسة مستخدم، إعادة التوجيه إلى صفحة تسجيل الدخول
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$isAdmin = $user['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            color: #333;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 50px auto;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .profile-pic:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #007bff;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-primary, .btn-outline-primary {
            width: 100%;
            margin-top: 15px;
        }
        .btn-secondary {
            margin-top: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="profile-container text-center">
            <?php if (!empty($user['profile_pic'])): ?>
                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="profile-pic mb-3">
            <?php else: ?>
                <p>No profile picture uploaded.</p>
            <?php endif; ?>

            <h2>Welcome, <?php echo htmlspecialchars($user['fname']) . ' ' . htmlspecialchars($user['family_name']); ?></h2>
            <p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>

            <!-- زر لتحديث صورة البروفايل -->
            <form method="POST" action="update_profile_pic.php" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="profile_pic" class="form-label">Update Profile Picture</label>
                    <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-outline-primary">Update Picture</button>
            </form>

            <!-- زر لتحديث الـ CV -->
            <form method="POST" action="update_cv.php" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="cv" class="form-label">Update CV (PDF only)</label>
                    <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn btn-outline-primary">Update CV</button>
            </form>

            <!-- زر لتحميل السيفي -->
            <?php if (!empty($user['cv'])): ?>
                <a href="<?php echo htmlspecialchars($user['cv']); ?>" class="btn btn-success mt-3" download>Download CV</a>
            <?php else: ?>
                <p>No CV uploaded.</p>
            <?php endif; ?>

            <?php if ($isAdmin): ?>
                <a href="admin_dashboard.php" class="btn btn-primary mt-3">Go to Admin Dashboard</a>
            <?php else: ?>
                <p>You are logged in as a regular user.</p>
            <?php endif; ?>

            <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
