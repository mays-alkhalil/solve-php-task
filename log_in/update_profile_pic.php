<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $profile_pic = $_FILES['profile_pic'];
    $file_name = $profile_pic['name'];
    $file_tmp = $profile_pic['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        $profile_pic_path = 'uploads/' . uniqid() . '.' . $file_ext;

        if (move_uploaded_file($file_tmp, $profile_pic_path)) {
            $sql = "UPDATE users SET profile_pic = :profile_pic WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':profile_pic' => $profile_pic_path,
                ':id' => $_SESSION['user']['id']
            ]);

            $_SESSION['user']['profile_pic'] = $profile_pic_path;
            header("Location: welcome.php");
            exit();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "Please upload a valid image file (jpg, jpeg, png, gif).";
    }
}
?>
