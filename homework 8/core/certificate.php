<?php
require_once __DIR__ . '/functions.php';
if (empty($_SESSION)) {
    header('Location: index.php');
}

if (array_key_exists('user', $_SESSION)) {
    $user = $_SESSION['user']['name'];
} elseif (array_key_exists('guest', $_SESSION)) {
    $user = $_SESSION['guest'];
}

$image = imagecreatetruecolor(1500, 1061);

$textColor = imagecolorallocate($image, 218,165,32);

$boxFile = __DIR__ . '/../img/certificate.jpg';
if (!file_exists($boxFile)) {
    echo 'Файл с картинкой не найден';
    exit();
}

$imBox = imagecreatefromjpeg($boxFile);

imagecopy($image, $imBox, 0, 0, 0, 0, 1500, 1061);

$fontFile = __DIR__ . '/../fonts/pacifico.ttf';
if (!file_exists($fontFile)) {
    echo 'Файл со шрифтом не найден';
    exit();
}

if (isset($_GET['count'])) {
    $count = $_GET['count'];
} else {
    die('Ошибка передачи количества баллов');
}

imagettftext($image, 30, 0, 650, 420, $textColor, $fontFile, 'выдан');
imagettftext($image, 30, 0, 650, 480, $textColor, $fontFile, $user);
imagettftext($image, 30, 0, 230, 540, $textColor, $fontFile, 'который(ая) при прохождении теста набрал(а) ' . $_GET['count'] . ' балла(ов)');
header('Content-Type: image/jpeg');
imagejpeg($image);
imagedestroy($image);




