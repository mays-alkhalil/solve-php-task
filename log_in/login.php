<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
            $_SESSION['is_admin'] = true;
        }

        header("Location: welcome.php");
        exit();
    } else {
        $loginError = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" required placeholder="Email" class="form-control mb-2">
            <input type="password" name="password" required placeholder="Password" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Login</button>
            <?php if (isset($loginError)) { echo '<div class="text-danger">'.$loginError.'</div>'; } ?>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
