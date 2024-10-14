<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $allowed_extensions = ['pdf'];
        $cv = $_FILES['cv'];
        $file_name = $cv['name'];
        $file_tmp = $cv['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_extensions)) {
            $cv_path = 'uploads/cv_' . uniqid() . '.' . $file_ext;

            if (move_uploaded_file($file_tmp, $cv_path)) {
                try {
                    $sql = "UPDATE users SET cv = :cv WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':cv' => $cv_path,
                        ':id' => $user['id']
                    ]);

                    $_SESSION['user']['cv'] = $cv_path;

                    header("Location: welcome.php");
                    exit();
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Failed to upload the CV.";
            }
        } else {
            echo "Please upload a valid CV file (PDF only).";
        }
    } else {
        echo "Error uploading file. Please make sure you selected a file.";
    }
}
?>
