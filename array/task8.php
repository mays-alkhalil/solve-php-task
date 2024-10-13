<?php
// تعريف المصفوفة الأصلية
$colors = array("red", "blue", "white", "yellow");

// دالة لتحويل جميع السلاسل النصية إلى أحرف كبيرة
function convertToUpperCase($array) {
    return array_map('strtoupper', $array);
}

// استدعاء الدالة وتحويل الألوان
$uppercaseColors = convertToUpperCase($colors);

// عرض النتيجة
echo "Array\n";
print_r($uppercaseColors);
?>
