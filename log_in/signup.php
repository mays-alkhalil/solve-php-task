<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $fname = $_POST['fname'] ?? '';
    $mname = $_POST['mname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $family_name = $_POST['family_name'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'] ?? 'user';

    // معالجة الصورة
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $profile_pic = $_FILES['profile_pic'];
        $file_name = $profile_pic['name'];
        $file_tmp = $profile_pic['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_extensions)) {
            // تحديد مسار لحفظ الصورة
            $profile_pic_path = 'uploads/' . uniqid() . '.' . $file_ext;

            // رفع الصورة إلى المجلد
            if (move_uploaded_file($file_tmp, $profile_pic_path)) {
                // معالجة السيرة الذاتية
                if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
                    $cv = $_FILES['cv'];
                    $cv_name = $cv['name'];
                    $cv_tmp = $cv['tmp_name'];
                    $cv_ext = strtolower(pathinfo($cv_name, PATHINFO_EXTENSION));

                    // التحقق من أن الملف بصيغة PDF
                    if ($cv_ext === 'pdf') {
                        // تحديد مسار لحفظ السيرة الذاتية
                        $cv_path = 'uploads/' . uniqid() . '.pdf';

                        // رفع السيرة الذاتية إلى المجلد
                        if (move_uploaded_file($cv_tmp, $cv_path)) {
                            try {
                                // إدخال البيانات إلى قاعدة البيانات مع مسار الصورة والسيرة الذاتية
                                $sql = "INSERT INTO users (fname, mname, lname, family_name, email, mobile, password, role, profile_pic, cv) 
                                        VALUES (:fname, :mname, :lname, :family_name, :email, :mobile, :password, :role, :profile_pic, :cv)";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':fname' => $fname,
                                    ':mname' => $mname,
                                    ':lname' => $lname,
                                    ':family_name' => $family_name,
                                    ':email' => $email,
                                    ':mobile' => $mobile,
                                    ':password' => $password,
                                    ':role' => $role,
                                    ':profile_pic' => $profile_pic_path,
                                    ':cv' => $cv_path
                                ]);

                                // توجيه المستخدم إلى صفحة الترحيب بعد التسجيل الناجح
                                header("Location: welcome.php");
                                exit(); 
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                        } else {
                            echo "Failed to upload the CV.";
                        }
                    } else {
                        echo "Please upload a valid PDF file.";
                    }
                } else {
                    echo "Error uploading CV. Please make sure you selected a file.";
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Please upload a valid image file (jpg, jpeg, png, gif).";
        }
    } else {
        echo "Error uploading file. Please make sure you selected a file.";
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
        <form method="POST" action="" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="profile_pic">Upload Profile Picture:</label>
                <input type="file" class="form-control" id="profile_pic" name="profile_pic" required>
            </div>
            <div class="form-group">
                <label for="cv">Upload CV (PDF only):</label>
                <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
            </div>
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
