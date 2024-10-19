<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['item_description'];
    $total_number = $_POST['item_total_number'];

    $target_dir = "uploads/";
    // $target_dir = "uploads/";: هنا نحدد المجلد الذي سيتم تخزين الصور فيه. في هذه الحالة، هو مجلد uploads/.
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
    // $target_file = $target_dir . basename($_FILES["item_image"]["name"]);: هنا نقوم بإنشاء مسار كامل للصورة المرفوعة عن طريق دمج اسم المجلد مع اسم الملف المرفوع. basename() تقوم بإرجاع اسم الملف فقط (بدون المسار).
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);

    $stmt = $pdo->prepare("INSERT INTO items (item_description, item_image, item_total_number) VALUES (?, ?, ?)");
    $stmt->execute([$description, $_FILES["item_image"]["name"], $total_number]);

    header('Location: items.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Item</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Add New Item</h1>
    <form method="POST" action="create_item.php" enctype="multipart/form-data">
        <label for="item_description">Description:</label>
        <input type="text" id="item_description" name="item_description" required>
        
        <label for="item_image">Image:</label>
        <input type="file" id="item_image" name="item_image" required>
        
        <label for="item_total_number">Total Number:</label>
        <input type="number" id="item_total_number" name="item_total_number" required>
        
        <button type="submit">Add Item</button>
    </form>
</body>
</html>
