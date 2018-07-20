<?php

if (empty($_GET['username'])) {
    http_response_code(400);
    echo 'Нет имени пользователя';
    exit();
}

$image = imagecreatetruecolor(1500, 1061);

$textColor = imagecolorallocate($image, 218,165,32);

$boxFile = __DIR__ . '/certificate.jpg';
if (!file_exists($boxFile)) {
    echo 'Файл с картинкой не найден';
    exit();
}

$imBox = imagecreatefromjpeg($boxFile);

imagecopy($image, $imBox, 0, 0, 0, 0, 1500, 1061);

$fontFile = __DIR__ . '/pacifico.ttf';
if (!file_exists($fontFile)) {
    echo 'Файл со шрифтом не найден';
    exit();
}


imagettftext($image, 30, 0, 650, 420, $textColor, $fontFile, 'выдан');
imagettftext($image, 30, 0, 500, 480, $textColor, $fontFile, $_GET['username']);
imagettftext($image, 30, 0, 230, 540, $textColor, $fontFile, 'который(ая) при прохождении теста набрал(а) ' . $_GET['count'] . ' балла(ов)');
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);



