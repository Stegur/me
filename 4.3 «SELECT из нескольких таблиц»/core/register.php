<?php
require_once '../core/db_enter.php';

if (array_key_exists('login', $_POST) && array_key_exists('pass', $_POST)) {
    $login = strip_tags($_POST['login']);
    $pass = strip_tags($_POST['pass']);
    $salt = "I don`t know how to use PHP";
    $password = md5($salt . $pass);
}

if (array_key_exists('login', $_POST) && array_key_exists('pass', $_POST)) {
    $sql = "SELECT * FROM user where login='" . $login . "' AND password='" . $password . "'";
    $user = $db->prepare($sql);
    $user->execute();
    $result = $user->fetch(PDO::FETCH_ASSOC);
    if ($result && array_key_exists('enter', $_POST)) {
        $_SESSION['login'] = $result['login'];
        $_SESSION['id'] = $result['id'];
        header('Location: ../index.php');
    } elseif (!$result && array_key_exists('enter', $_POST)) {
        echo "<p>Такой пользователь не существует, либо неверный пароль.</p>";
    } elseif ($result && array_key_exists('reg', $_POST)) {
        echo "<p>Такой пользователь уже существует в базе данных.</p>";
    } elseif (!$result && array_key_exists('reg', $_POST)) {
        $sql = "INSERT INTO user(`id`, `login`, `password`) VALUES (null ,'" . $login . "','" . $password . "')";
        $addNewUser = $db->prepare($sql);
        $addNewUser->execute();
        
        $sql = "SELECT * FROM user where login='" . $login . "'";
        $userEnter = $db->prepare($sql);
        $userEnter->execute();
        $result = $userEnter->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = $result['login'];
        $_SESSION['id'] = $result['id'];
        header('Location: ../index.php');
    }
} else {
    echo "<p>Введите данные для регистрации или войдите, если уже регистрировались:</p>";
}


//echo '<pre>';
//var_dump($_POST);
//var_dump($_SESSION);
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