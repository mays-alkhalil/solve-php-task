<?php
// دالة لعكس السلسلة النصية
function reverseString($inputString) {
    return strrev($inputString);
}

// اختبار الدالة
$input = "remove";
$reversed = reverseString($input);

// عرض النتيجة
echo "Original String: $input\n";
echo "Reversed String: $reversed\n";
?>
