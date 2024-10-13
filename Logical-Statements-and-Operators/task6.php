<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
</head>
<body>
    <h2>Simple Calculator</h2>
    <form method="post">
        <input type="number" name="number1" required placeholder="Enter first number">
        <input type="number" name="number2" required placeholder="Enter second number">
        <br><br>
        <select name="operation" required>
            <option value="" disabled selected>Select operation</option>
            <option value="add">Addition</option>
            <option value="subtract">Subtraction</option>
            <option value="multiply">Multiplication</option>
            <option value="divide">Division</option>
        </select>
        <br><br>
        <input type="submit" value="Calculate">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // استلام المدخلات من النموذج
        $number1 = $_POST['number1'];
        $number2 = $_POST['number2'];
        $operation = $_POST['operation'];
        $result = 0;

        // تحديد العملية المطلوبة
        switch ($operation) {
            case 'add':
                $result = $number1 + $number2;
                break;
            case 'subtract':
                $result = $number1 - $number2;
                break;
            case 'multiply':
                $result = $number1 * $number2;
                break;
            case 'divide':
                // تحقق من عدم القسمة على الصفر
                if ($number2 != 0) {
                    $result = $number1 / $number2;
                } else {
                    $result = "Cannot divide by zero";
                }
                break;
        }

        // عرض النتيجة
        echo "<h3>Result: $result</h3>";
    }
    ?>
</body>
</html>
