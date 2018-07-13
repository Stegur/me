<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка тестов на сервер</title>
</head>
<body>
<form action="admin.php" method="post">
    <div>Загрузить форму на сервер</div>
    <div><input type="file" name="tests"></div>
    <div><input type="submit" value="Отправить"></div>
</form>
<?php
if (!empty($_FILES) || array_key_exists('tests', $_FILES)) {
    move_uploaded_file($_FILES['tests']['tmp_name'], 'tests.json');
    echo '<h2>Файл успешно загружен</h2>';
} else {
    echo '<h2>Файл не загружен</h2>';
}
?>

</body>
</html>