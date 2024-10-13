<?php
function checkNumber($number) {
    // التحقق مما إذا كان الرقم موجبًا، سالبًا، أو صفرًا
    if ($number > 0) {
        return "Positive";
    } elseif ($number < 0) {
        return "Negative";
    } else {
        return "Zero";
    }
}

// اختبار الدالة
$inputNumber = -60; // أدخل الرقم
$result = checkNumber($inputNumber);

// عرض النتيجة
echo "$result";
?>
