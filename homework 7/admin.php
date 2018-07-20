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

</body>
</html>