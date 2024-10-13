<?php
// المصفوفة الأصلية
$array = array(1, 2, 3, 4, 5);

// الموقع الذي نريد إدراج العنصر فيه (البدء من 1)
$location = 4;

// العنصر الجديد الذي نريد إضافته
$new_item = '$';

// استخدام array_splice لإدراج العنصر في المكان المحدد
array_splice($array, $location - 1, 0, $new_item);
// (--,index3,number items want deleted,--)
// عرض المصفوفة الجديدة
foreach ($array as $item) {
    echo $item . " ";
}
?>
