<?php
session_start();
include 'db_connection.php'; // تأكد من أن هذا الملف يحتوي على كود الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    // استعلام لتحديث بيانات المستخدم
    $stmt = $pdo->prepare("UPDATE users SET fname = :fname, lname = :lname, email = :email WHERE id = :id");
    $stmt->execute([
        ':fname' => $fname,
        ':lname' => $lname,
        ':email' => $email,
        ':id' => $id
    ]);

    header("Location: admin_dashboard.php");
    exit();
}

// جلب بيانات المستخدم للتحرير
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit User</h2>
        <form action="edit_user.php" method="POST" class="w-50 mx-auto">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
            <div class="form-group mb-3">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?= htmlspecialchars($user['lname']) ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</body>
</html>
