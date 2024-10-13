<?php
// المصفوفة الأصلية
$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

// ترتيب المصفوفة حسب المفاتيح
ksort($fruits);

// عرض المصفوفة بعد الترتيب
foreach ($fruits as $key => $value) {
    echo "$key = $value<br>";
}
?>
