<?php
include 'includes/db.php';

// استعلام لجلب تفاصيل العنصر
$item_id = $_GET['id'];
$sql = "SELECT * FROM items WHERE item_id = :item_id AND is_deleted = 0";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
</head>
<body>
    <h1><?= $item['item_description']; ?></h1>
    <img src="<?= $item['item_image']; ?>" alt="<?= $item['item_description']; ?>" width="300">
    <p><?= $item['item_description']; ?></p>

    <form action="add_to_cart.php" method="POST">
        <input type="hidden" name="item_id" value="<?= $item['item_id']; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
