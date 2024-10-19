<?php
include 'includes/db.php';

// استعلام لجلب جميع الفئات
$sql = "SELECT * FROM category";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    <h1>Categories</h1>
    <div>
        <?php foreach ($categories as $category): ?>
            <a href="category_view.php?id=<?= $category['category_id']; ?>"><?= $category['category_name']; ?></a><br>
        <?php endforeach; ?>
    </div>
</body>
</html>
