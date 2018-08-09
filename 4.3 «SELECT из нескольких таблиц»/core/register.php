<?php
require_once '../core/db_enter.php';

if (array_key_exists('login', $_POST) && array_key_exists('pass', $_POST)) {
    $login = strip_tags($_POST['login']);
    $pass = md5(strip_tags($_POST['pass']));
}

if (array_key_exists('reg', $_POST)) {
    $sql = "SELECT * FROM user where login='" . $login . "'";
    $is_user = $db->query($sql);
    foreach ($is_user as $user) {
        if ($user['login'] == $login) {
            echo "<p>Такой пользователь уже существует в базе данных.</p>";
        }
    }
    if () { // что вставить как условие?
        $salt = "I don`t know how to use PHP";
        $password = md5($salt . $pass);
        $sql = "INSERT INTO user(`id`, `login`, `password`) VALUES (null ,'" . $login . "','" . $password . "')";
        echo $sql;
    }
} else {
    echo "<p>Введите данные для регистрации или войдите, если уже регистрировались:</p>";
}

//echo '<pre>';
//var_dump($_POST);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>

<form action="register.php" method="post">
    <input type="text" name="login" placeholder="Логин"> <input type="password" name="pass" placeholder="Пароль">
    <input type="submit" value="Вход" name="enter"> <input type="submit" value="Регистрация" name="reg">
</form>
</body>
</html>