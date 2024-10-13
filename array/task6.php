<?php
// درجات الحرارة المسجلة
$temperatures = array(78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73);

// حساب متوسط درجات الحرارة
$average = array_sum($temperatures) / count($temperatures);

// فرز المصفوفة للحصول على أدنى وأعلى الدرجات
sort($temperatures);

// الحصول على أدنى 5 درجات
$lowest = array_slice($temperatures, 0, 5);

// الحصول على أعلى 5 درجات
$highest = array_slice($temperatures, -5);

// عرض النتائج
echo "Average Temperature is: " . number_format($average, 1) . "<br>"; // تنسيق المتوسط ليظهر بعدد صحيح واحد
echo "List of five lowest temperatures: " . implode(", ", $lowest) . "<br>";
echo "List of five highest temperatures: " . implode(", ", $highest) . "<br>";
?>
