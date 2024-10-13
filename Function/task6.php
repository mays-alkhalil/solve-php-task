<?php
// دالة لإزالة القيم المكررة من مصفوفة
function removeDuplicates($array) {
    return array_unique($array);
}

// اختبار الدالة
$array1 = array(2, 4, 7, 4, 8, 4);
$array1 = removeDuplicates($array1);

// عرض النتيجة
print_r($array1);
?>
