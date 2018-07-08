<?php
$file = 'http://api.openweathermap.org/data/2.5/weather?q=Berlin&appid=c6ab93625cf06ca721d6ceece09a33ab';

$fileContent = file_get_contents($file);
$json = json_decode($fileContent, 1);

$tempK = $json['main']['temp'];
$tempC = $tempK - 273.15;

$humidity = $json['main']['humidity'];
$pressure = $json['main']['pressure'];
$wind = $json['wind']['speed'];

echo '<img src="https://u.cubeupload.com/Stegur/tempPic.jpg" alt="Temp" style="width: 55px; float: left">';
echo '<h4>Погода в ' . $json['name'] . ':</h4>';
if ($tempC >= 25) {
    echo 'Температура - <span style="color: red">' . $tempC . '°C</span><br/>';
} elseif ($tempC >= 15 && $tempC < 25) {
    echo 'Температура - <span style="color: orange">' . $tempC . '°C</span><br/>';
} else {
    echo 'Температура - <span style="color: blue">' . $tempC . '°C</span><br/>';
}
echo 'Влажность - ' . $humidity . '%<br/>';
echo 'Давление - ' . $pressure . ' мм. рт. ст.<br/>';

if ($wind <= 3) {
    echo 'Ветер - штиль, ' . $wind . ' м/с<br/>';
} elseif ($wind > 3 && $wind <= 5) {
    echo 'Ветер - умеренный, ' . $wind . ' м/с<br/>';
} elseif ($wind > 5 && $wind <= 10) {
    echo 'Ветер - сильный, ' . $wind . ' м/с<br/>';
} else {
    echo 'Ветер - ураган, ' . $wind . ' м/с! Бегите, глупцы!<br/>';
}




