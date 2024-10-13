<?php
function calculateElectricityBill($units) {
    $bill = 0;

    if ($units <= 50) {
        $bill = $units * 2.50; // الأسعار للـ 50 وحدة الأولى
    } elseif ($units <= 150) {
        $bill = (50 * 2.50) + (($units - 50) * 5.00); // 50 وحدة أولى و100 وحدة تالية
    } elseif ($units <= 250) {
        $bill = (50 * 2.50) + (100 * 5.00) + (($units - 150) * 6.20); // 50 + 100 وحدة
    } else {
        $bill = (50 * 2.50) + (100 * 5.00) + (100 * 6.20) + (($units - 250) * 7.50); // جميع الوحدات
    }

    return $bill;
}

// اختبار الدالة
$units = 300; // أدخل عدد الوحدات
$totalBill = calculateElectricityBill($units);

// عرض النتيجة
echo "Total Electricity Bill for $units units is: " . $totalBill . " JOD"; 
?> 