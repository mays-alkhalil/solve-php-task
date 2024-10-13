<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // جمع البيانات من النموذج مع التحقق من وجودها
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $family_name = isset($_POST['family_name']) ? $_POST['family_name'] : '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : 'user'; 

    try {
        // إعداد الاستعلام
        $sql = "INSERT INTO users (fname, mname, lname, family_name, email, mobile, password, role) 
                VALUES (:fname, :mname, :lname, :family_name, :email, :mobile, :password, :role)";
        $stmt = $pdo->prepare($sql);
        
        // تنفيذ الاستعلام
        $stmt->execute([
            ':fname' => $fname,
            ':mname' => $mname,
            ':lname' => $lname,
            ':family_name' => $family_name,
            ':email' => $email,
            ':mobile' => $mobile,
            ':password' => $password,
            ':role' => $role
        ]);

        // توجيه المستخدم إلى صفحة الترحيب بعد التسجيل الناجح
        header("Location: welcome.php");
        exit(); // تأكد من إنهاء السكربت بعد إعادة التوجيه
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="form-group">
                <label for="mname">Middle Name:</label>
                <input type="text" class="form-control" id="mname" name="mname">
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>
            <div class="form-group">
                <label for="family_name">Family Name:</label>
                <input type="text" class="form-control" id="family_name" name="family_name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <!-- إضافة حقل اختيار الدور -->
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body> 
</html> 
