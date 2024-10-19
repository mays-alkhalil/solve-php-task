<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['user_name'];
    $mobile = $_POST['user_mobile'];
    $email = $_POST['user_email'];
    $address = $_POST['user_address'];

    $stmt = $pdo->prepare("INSERT INTO users (user_name, user_mobile, user_email, user_address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $mobile, $email, $address]);

    header('Location: users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Add New User</h1>
    <form method="POST" action="create_user.php">
        <label for="user_name">Name:</label>
        <input type="text" id="user_name" name="user_name" required>
        
        <label for="user_mobile">Mobile:</label>
        <input type="text" id="user_mobile" name="user_mobile" required>
        
        <label for="user_email">Email:</label>
        <input type="email" id="user_email" name="user_email" required>
        
        <label for="user_address">Address:</label>
        <input type="text" id="user_address" name="user_address" required>
        
        <button type="submit">Add User</button>
    </form>
</body>
</html>
