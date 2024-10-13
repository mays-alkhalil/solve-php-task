<?php
// دالة لتبديل قيم متغيرين
function swapVariables(&$x, &$y) {
    $temp = $x;
    $x = $y;
    $y = $temp;
}

// اختبار الدالة
$x = 12;
$y = 10;

echo "Before swapping: x = $x, y = $y\n";

// استدعاء الدالة لتبديل المتغيرين
swapVariables($x, $y);

echo "After swapping: x = $x, y = $y\n";
?>
