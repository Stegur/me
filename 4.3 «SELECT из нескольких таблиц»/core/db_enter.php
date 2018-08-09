<?php

session_start();

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'todo');
define('DB_USER', 'root');
define('DB_PASS', '');

if (array_key_exists('list', $_POST)) {
    if ($_POST['list'] == 'date') {
        $sql = "SELECT * FROM tasks ORDER BY date_added";
    } elseif ($_POST['list'] == 'done') {
        $sql = "SELECT * FROM tasks ORDER BY is_done";
    } elseif ($_POST['list'] == 'description') {
        $sql = "SELECT * FROM tasks ORDER BY description";
    }
} else {
    $sql = "SELECT * FROM tasks";
}

$connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$db = new PDO($connect_str, DB_USER, DB_PASS);

$result = $db->query($sql);

$error_array = $db->errorInfo();
if ($db->errorCode() != 0000) {
    echo "SQL ошибка: " . $error_array[2] . '<br>';
}