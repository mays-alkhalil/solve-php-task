<?php
// المصفوفة التي تحتوي على الدول وعواصمها
$cities = array(
    "Italy" => "Rome",
    "Luxembourg" => "Luxembourg",
    "Belgium" => "Brussels",
    "Denmark" => "Copenhagen",
    "Finland" => "Helsinki",
    "France" => "Paris",
    "Slovakia" => "Bratislava",
    "Slovenia" => "Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland" => "Dublin",
    "Netherlands" => "Amsterdam",
    "Portugal" => "Lisbon",
    "Spain" => "Madrid"
);

// ترتيب المصفوفة حسب العواصم
asort($cities);

// عرض العواصم والدول
foreach ($cities as $country => $capital) {
    echo "The capital of $country is $capital.<br>";
}
?>
