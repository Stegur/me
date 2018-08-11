<?php


define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'tables');
define('DB_USER', 'root');
define('DB_PASS', '');


$connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$db = new PDO($connect_str, DB_USER, DB_PASS);

if (!empty($_POST)) {
    $cols = (int)$_GET['cols'];
    $sql1 = "DROP TABLE IF EXISTS `{$_GET['name']}`;
CREATE TABLE `{$_GET['name']}` (
`id` int NOT NULL AUTO_INCREMENT,";
    
    
    for ($i = 0; $i < $cols; $i++) {
        $col = 'col' . $i;
        $param = 'param' . $i;
        $sql2[$i] = ' ' . strip_tags($_POST[$col]) . ' ' . strip_tags($_POST[$param]) . ' NULL, ';
        
    }
    
    $sql3 = "
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
}
// todo Пожалуйста, помогите оптимизироапть кодя, что бы работал для любого количества ячеек!
$sql = $sql1 . $sql2[1] . $sql2[2] . $sql2[3] . $sql3;

$pleaseWork = $db->prepare($sql);
$pleaseWork->execute();

$error_array = $db->errorInfo();
if ($db->errorCode() != 0000) {
    echo "SQL ошибка: " . $error_array[2] . '<br>';
}