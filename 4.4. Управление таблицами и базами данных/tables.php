<?php
require_once 'db_enter.php';
if (array_key_exists('tablename', $_GET)) {
    $tableName = strip_tags($_GET['tablename']);
    $location = "Location: tables.php?tablename={$tableName}";
    $sql = "DESCRIBE {$tableName};";
    $showTable = $db->prepare($sql);
    $showTable->execute();
    $result = $showTable->fetchAll(PDO::FETCH_ASSOC);
}

if (array_key_exists('add', $_POST)) {
    $newField = strip_tags($_POST['add']);
    $sql = "ALTER TABLE {$tableName} ADD {$newField}";
    $add = $db->prepare($sql);
    $add->execute();
    header($location);
}

if (array_key_exists('action', $_GET)) {
    $field = strip_tags($_GET['field']);
    if ($_GET['action'] == 'changename' && array_key_exists('name', $_POST)) {
        $oldName = strip_tags($_GET['field']);
        $newName = strip_tags($_POST['name']);
        $sql = "ALTER TABLE {$tableName} CHANGE {$oldName} {$newName}";
        $updateName = $db->prepare($sql);
        $updateName->execute();
        header($location);
    }
    if ($_GET['action'] == 'changetype') {
    
    }
    if ($_GET['action'] == 'delete') {
        $sql = "ALTER TABLE {$tableName} DROP COLUMN {$field}";
        $delete = $db->prepare($sql);
        $delete->execute();
        header($location);
        
    }
}
echo '<pre>';
var_dump($_GET);
var_dump($_POST);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Просмотр и редактирование таблицы</title>
</head>
<body>
<h1>Просмотр и редактирование таблицы <?= strip_tags($_GET['tablename']) ?></h1>
<?php
if (array_key_exists('action',$_GET) && $_GET['action'] == 'changename') :?>
<p>Введите новое имя поля и его параметры</p>
    <form action="tables.php?tablename=<?= $tableName ?>&field=<?= strip_tags($_GET['field']) ?>&action=changename" method="post">
        <input type="text" name="name" value="<?= strip_tags($_GET['field']) ?> "><input type="submit"value="Изменить имя поля">
    </form>
<?php endif;?>

<table>
    <thead>
    <tr>
        <td>Field</td>
        <td>Type</td>
        <td>Null</td>
        <td>Key</td>
        <td>Default</td>
        <td>Extra</td>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $data) : ?>
            <tr>
                <td><?= $data['Field'] ?><br>
                    <a class="small" href="tables.php?tablename=<?= $tableName ?>&field=<?= $data['Field'] ?>&action=changename">изменить название</a><br>
                    <a class="small" href="tables.php?tablename=<?= $tableName ?>&field=<?= $data['Field'] ?>&action=changetype">изменить тип</a><br>
                    <a class="small" href="tables.php?tablename=<?= $tableName ?>&field=<?= $data['Field'] ?>&action=delete">удалить поле</a><br>
                </td>
                <td><?= $data['Type'] ?></td>
                <td><?= $data['Null'] ?></td>
                <td><?= $data['Key'] ?></td>
                <td><?= ($data['Default'] == null) ? 'NULL' : $data['Default'] ?></td>
                <td><?= $data['Extra'] ?></td>
            </tr>
        <? endforeach; ?>
        <form action="tables.php?tablename=<?= $tableName ?>" method="post">
            <input type="text" placeholder="имя поля с парметрами" name="add">
            <input type="submit" value="Добавить поле">
        </form>
    </tbody>
</table>

<p><a href="index.php">Создать новую таблицу или поссмотреть существующие</a></p>
</body>
</html>