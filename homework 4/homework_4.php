<?php
$file = 'berlin.json';

$link = 'http://api.openweathermap.org/data/2.5/weather';
$city = 'mcmurdo+station';
$appid = 'c6ab93625cf06ca721d6ceece09a33ab';
$file = "$link?q=$city&appid=$appid";


$fileContent = file_get_contents($file) or exit("Не удалось загрузить данные");
$json = json_decode($fileContent, true);
if ($json === null){
    exit("Ошибка декодированния JSON");
}

$cityName = (!empty($json['name'])) ? $json['name'] : 'не удалось получить название города' ;

$pictureCode = $json['weather'][0]['icon'];
$picture = 'http://openweathermap.org/img/w/' . $pictureCode . '.png';


$tempK = $json['main']['temp']; // or exit("Неудалось загрузить температуру");
$tempC = $tempK - 273.15;
//if ($tempK === null){
//    $tempC = "Неудалось загрузить данные температуры";
//} else {
//    $tempC = $tempC . "°C";
//}
$tempC = (empty($tempK)) ? "Неудалось загрузить данные температуры" : $tempC . '°C';

$humidity = $json['main']['humidity'];
//if ($humidity === null){
//    $humidity = "Неудалось загрузить данные влажности";
//} else {
//    $humidity = $humidity . "%";
//}
$humidity = (empty($humidity)) ? "Неудалось загрузить данные влажности" : $humidity . '%';

$pressure = $json['main']['pressure'];
//if ($pressure === null){
//    $pressure = "Неудалось загрузить данные давления";
//} else {
//    $pressure = $pressure . " мм. рт. ст.";
//}
$pressure = (empty($pressure)) ? "Неудалось загрузить данные давления" : $pressure . ' мм. рт. ст.';

$wind = $json['wind']['speed'];
//if ($wind === null){
//    $wind = "Неудалось загрузить скорость ветра";
//} else {
//    $wind = $wind . " м/с";
//}
$wind = (empty($wind)) ? "Неудалось загрузить скорость ветра" : $wind . ' м/с';



if ($tempC >= 25) {
    $tempC = '<span style="color: red">' . $tempC . '</span>';
} elseif ($tempC >= 15 && $tempC < 25) {
    $tempC = '<span style="color: orange">' . $tempC . '</span>';
} else {
    $tempC = '<span style="color: blue">' . $tempC . '</span>';
}

if ($wind <= 3) {
    $wind = 'штиль, ' . $wind;
} elseif ($wind > 3 && $wind <= 5) {
    $wind = 'умеренный, ' . $wind;
} elseif ($wind > 5 && $wind <= 10) {
    $wind = 'сильный, ' . $wind;
} else {
    $wind = 'ураган, ' . $wind . '! Бегите, глупцы!';
}
?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>My Weather Station</title>
    </head>
    <body>
        <div style="width: 300px; margin: auto; text-align: center">
            <h3>Погода в <?= $cityName ?></h3>
            <img src="<?= $picture ?>" alt="Weather Icon">
            <p>Температура - <?= $tempC ?></p>
            <p>Влажность - <?= $humidity ?></p>
            <p>Давление - <?= $pressure ?></p>
            <p>Ветер - <?= $wind ?></p>
            
        </div>
    </body>
</html>



