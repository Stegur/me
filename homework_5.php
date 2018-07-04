<?php
$file = 'berlin.json';

$fileContent = file_get_contents($file);
$json = json_decode($fileContent, 1);

$tempK = $json['main']['temp'];
$tempC = $tempK - 273.15;

$humidity = $json['main']['humidity'];
echo  'Температура в ' . $json['name'] . ' = ' . $tempC . '°C';
