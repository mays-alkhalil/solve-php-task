<?php
// دالة للتحقق مما إذا كان الرقم هو عدد أرمسترونغ
function isArmstrong($number) {
    $sum = 0;
    $digits = str_split($number); // تحويل الرقم إلى مصفوفة من الأرقام

    // حساب مجموع مكعبات الأرقام
    foreach ($digits as $digit) {
        $sum += pow($digit, 3);
    }

    // التحقق إذا كان المجموع يساوي الرقم الأصلي
    if ($sum == $number) {
        return true;
    } else {
        return false;
    }
}

// اختبار الدالة
$inputNumber = 407;

if (isArmstrong($inputNumber)) {
    echo "$inputNumber is an Armstrong Number";
} else {
    echo "$inputNumber is not an Armstrong Number";
}
?>
