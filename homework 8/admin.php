<?php
require_once __DIR__ . '/core/functions.php';
if (array_key_exists('user', $_SESSION)) {
    echo "<div><a href='core/logout.php'>Выйти из сессии</a></div>";
}
if (!array_key_exists('user', $_SESSION)) {
    http_response_code(403);
    die('403 Forbidden');
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка тестов на сервер</title>
</head>
<body>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <div>Загрузить тест на сервер</div>
    <div><input type="file" name="tests"></div>
    <div><input type="submit" value="Отправить"></div>
</form>
<?php

if (!empty($_FILES) || array_key_exists('tests', $_FILES)) {
    $dest = __DIR__ . '/tests/';
    $newFile = $dest . basename($_FILES['tests']['name']);
    move_uploaded_file($_FILES['tests']['tmp_name'], $newFile);
    header('Location: list.php');
} else {
    echo '<h2>Файл не загружен</h2>';
}
?>
<p><a href="list.php">Перейти к списку тестов</a></p>
<p><a href="test.php">Перейти к тестам</a></p>
</body>
</html>