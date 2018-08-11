<?php

include_once 'db_enter.php';

//echo '<pre>';
//var_dump($_GET);
//var_dump($_POST);


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Tables</title>
</head>
<body>

<h1>Добро пожаловать в конструктор таблиц MySQL</h1>
<!--todo вставить кгопку отвменить все на каждом этапе-->
<?php
if (empty($_GET)) :?>
    <p>
    <form action="index.php" method="get">
        Я хочу создать таблицу
        <input type="text" name="name" placeholder="название таблицы"> на
        <input type="text" name="cols" placeholder="количество ячеек"> ячеек
        <input type="submit" value="Создать">
    </form></p>
<?php elseif (empty($_POST)) :
    $cols = (int)$_GET['cols'];
    $name = strip_tags($_GET['name']); ?>
    <p>Введите названия столбцов для вашей таблицы и их парметры</p>
    <form action="index.php?cols=<?= $cols ?>&name=<?= $name ?>" class="create-rows" method="post">
        <table>
            <?php
            for ($i = 0; $i < $cols; $i++) {
                echo '<tr><td><input type="text" placeholder="название столбца" name="col' . $i . '"></td> ';
                echo '<td><select name="param' . $i . '">';
                echo '<option value="int">int</option>';
                echo '<option value="varchar (100)">varchar</option>';
                echo '</select></td></tr>';
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Создать таблицу '<?= $name ?>' на <?= $cols ?> столбцов">
    </form>
<?php endif;
if (array_key_exists('name', $_GET)) {
    $tableName = strip_tags($_GET['name']);
    $sql = "CHECK TABLE {$tableName}";
    $findTable = $db->prepare($sql);
    $findTable->execute();
    $isExist = $findTable->fetch(PDO::FETCH_ASSOC);
    if ($isExist['Msg_text'] == 'OK') {
        echo "<h2>Ваша таблица {$tableName} создана</h2>";
    } else {
        echo "<h2>Ваша таблица {$tableName} не создана</h2>";
    }
}
?>
</body>
</html>