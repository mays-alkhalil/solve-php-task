<?php
// دالة للتحقق من ما إذا كان العدد أولي
function isPrime($number) {
    if ($number <= 1) {
        return false; // الأعداد أقل من أو تساوي 1 ليست أولية
    }
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false; // إذا كان هناك قاسم آخر، فهو ليس أولي
        }
    }
    return true; // إذا لم يوجد قواسم أخرى، فهو عدد أولي
}

// إدخال الرقم
$inputNumber = 3; // يمكنك تغيير الرقم هنا

// التحقق مما إذا كان العدد أولي
if (isPrime($inputNumber)) {
    echo "$inputNumber is a prime number";
} else {
    echo "$inputNumber is not a prime number";
}
?>
