<?php
require_once __DIR__ . '/functions.php';
if (!empty($_SESSION)) {
    echo "<div><a href='logout.php'>Выйти из сессии</a></div>";
}

if (array_key_exists('user', $_SESSION)) {
    echo 'Добро пожаловать, ' . $_SESSION['user']['name'];
} elseif (array_key_exists('guest', $_SESSION)) {
    echo 'Добро пожаловать, ' . $_SESSION['guest'] . '. У Вас нет прав добавлять или удалять тесты';
} else {
    header('Location: index.php');
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<p>Список доступных тестов:</p>
<div style="float: left">
<?php

$files = scandir(__DIR__ . '/tests/');
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $testName = substr($file, 0, -5);
        $link = "<a href=\"test.php?test={$testName}\">{$testName}</a>";
        echo $link . '<br>';
        if (array_key_exists('user', $_SESSION)) {
            echo " - <a href=\"list.php?del={$file}\">Удалить {$testName}</a><br>";
            if (array_key_exists('del',$_GET)) {
                unlink(__DIR__ . "/tests/{$_GET['del']}");
                header('Location: list.php');
            }
        }
    }
}

?>
</div>
<div style="clear: both">
<?php if (array_key_exists('user', $_SESSION)) : ?>
    <p><a href="admin.php">Перейти к загрузке тестов</a><br></p>
<?php endif; ?>
    <p><a href="test.php">Перейти к тестам</a></p></div>
</body>
</html>