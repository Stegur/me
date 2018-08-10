<?php

session_start();

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'todo');
define('DB_USER', 'root');
define('DB_PASS', '');

if (array_key_exists('list', $_POST)) {
    if ($_POST['list'] == 'date') {
        $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id ORDER BY date_added";
    } elseif ($_POST['list'] == 'done') {
        $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id ORDER BY is_done";
    } elseif ($_POST['list'] == 'description') {
        $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id ORDER BY description";
    } elseif ($_POST['list'] == 'assigned') {
        $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id ORDER BY assigned_user_id";
    } elseif ($_POST['list'] == 'author') {
        $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id ORDER BY user_id";
    }
} else {
    $sql = "SELECT t.id, t.user_id ,t.assigned_user_id, t.description, t.is_done, t.date_added, u.login FROM task as t JOIN user AS u ON u.id=t.user_id";
}

$connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$db = new PDO($connect_str, DB_USER, DB_PASS);

$tasks = $db->query($sql);

$error_array = $db->errorInfo();
if ($db->errorCode() != 0000) {
    echo "SQL ошибка: " . $error_array[2] . '<br>';
}