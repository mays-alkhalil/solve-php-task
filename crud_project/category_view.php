<?php
include 'includes/db.php';

// استعلام لجلب العناصر الخاصة بالفئة
$category_id = $_GET['id'];
$sql = "SELECT * FROM items WHERE category_id = :category_id AND is_deleted = 0";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category View</title>
</head>
<body>
    <h1>Items in this Category</h1>
    <div>
        <?php foreach ($items as $item): ?>
            <div>
                <a href="item_details.php?id=<?= $item['item_id']; ?>">
                    <img src="<?= $item['item_image']; ?>" alt="<?= $item['item_description']; ?>" width="100">
                    <p><?= $item['item_description']; ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
