<?php
function checkVotingEligibility($age) {
    // الحد الأدنى للسن المطلوب للتصويت
    $minimumAge = 18;

    // تحقق مما إذا كان العمر أكبر من أو يساوي الحد الأدنى
    if ($age >= $minimumAge) {
        return "is eligible to vote";
    } else {
        return "is not eligible to vote";
    }
}

// اختبار الدالة
$age = 15; // أدخل العمر
$result = checkVotingEligibility($age);

// عرض النتيجة
echo "$age $result";
?>
