<?php
// إنشاء المصفوفة بالألوان
$colors = array('white', 'green', 'red');

// بدء القائمة غير المرتبة
echo "<ul>";

// استخدام حلقة foreach للمرور على كل لون في المصفوفة
foreach ($colors as $color) {
    // عرض اللون كعنصر في القائمة
    echo "<li>$color</li>";
}

// إنهاء القائمة غير المرتبة
echo "</ul>";
?>
