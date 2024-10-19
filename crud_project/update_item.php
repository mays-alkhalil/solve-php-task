<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM items WHERE item_id = ? AND is_deleted = 0");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        header('Location:items.php'); // إعادة توجيه إذا لم يتم العثور على العنصر
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $description = $_POST['item_description'];
        $total_number = $_POST['item_total_number'];

        if ($_FILES["item_image"]["name"]) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
            move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);
            $image_name = $_FILES["item_image"]["name"];
        } else {
            $image_name = $item['item_image']; // الحفاظ على الصورة الحالية
        }

        $stmt = $pdo->prepare("UPDATE items SET item_description = ?, item_image = ?, item_total_number = ? WHERE item_id = ?");
        $stmt->execute([$description, $image_name, $total_number, $item_id]);

        header('Location: items.php'); // إعادة توجيه بعد التحديث
    }
} else {
    header('Location: items.php'); // إعادة توجيه إذا لم يكن هناك معرف
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Update Item</h1>
    <form method="POST" action="update_item.php?id=<?php echo $item_id; ?>" enctype="multipart/form-data">
        <label for="item_description">Description:</label>
        <input type="text" id="item_description" name="item_description" value="<?php echo $item['item_description']; ?>" required>
        
        <label for="item_image">Image:</label>
        <input type="file" id="item_image" name="item_image">
        <img src="uploads/<?php echo $item['item_image']; ?>" alt="Current Image" width="100"><!-- عرض الصورة الحالية -->
        
        <label for="item_total_number">Total Number:</label>
        <input type="number" id="item_total_number" name="item_total_number" value="<?php echo $item['item_total_number']; ?>" required>
        
        <button type="submit">Update Item</button>
    </form>
</body>
</html>
