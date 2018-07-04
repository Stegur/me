<?php
$file = 'berlin.json';

$fileContent = file_get_contents($file);
$json = json_decode($fileContent, 1);

echo '<pre>';

foreach ($json as $key => $section) {
//    print_r($key);
//    print_r($section);
//    echo '<br>';
    if (is_array($section)) {
        foreach ($section as $param => $value) {
//            var_dump($param);
            if (is_array($value)) {
                foreach ($value as $numbers => $number) {
//                    var_dump($numbers);
//                    var_dump($number);
                }
            } else {
//                var_dump($value);
            }
        }
    } else {
//        var_dump($section);
    }
}

$tempK = $json['main']['temp'];
$tempC = $tempK - 273.15;
echo $tempC . '°C';
