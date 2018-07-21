<?php
require_once __DIR__ . '/functions.php';

if (!empty($_SESSION)) {
    header('Location: list.php');
}

$errors = [];
if (array_key_exists('login', $_POST) && array_key_exists('password', $_POST)) {
    if (login($_POST['login'], $_POST['password'])) {
        header('Location: list.php');
    } else {
        $errors[] = 'Неверный логин или пароль';
    }
}

if (array_key_exists('username', $_POST)) {
    $_SESSION['guest'] = htmlspecialchars($_POST['username']);
    header('Location: list.php');
    
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Войти</title>
</head>
<body>
<div>
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<div style="float: left">
    <form action="index.php" method="post">
        <p>Войти как пользователь</p>
        <p>Введите Логин</p>
        <input type="text" placeholder="Логин" name="login">
        <p>Введите Пароль</p>
        <input type="password" placeholder="Пароль" name="password"><br>
        <input type="submit" value="Войти">
    </form>
</div>
<div style="float: left; margin-left: 20px">
    <form action="index.php" method="post">
        <p>Войти как гость</p>
        <p>Введите Имя</p>
        <input type="text" placeholder="Имя" name="username"><br>
        <input type="submit" value="Войти">
    </form>
</div>
</body>
</html>