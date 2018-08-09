<?php

require_once 'core/db_enter.php';

if (array_key_exists('add', $_POST)) {
    $add = "INSERT INTO `tasks`(`description`, `is_done`, `date_added`) VALUES ('" . strip_tags($_POST['add']) . "', 0, CURRENT_TIMESTAMP)";
    $db->exec($add);
    header('Location: index.php');
}
if (array_key_exists('action', $_GET)) {
    if ($_GET['action'] == 'delete') {
        $delete = "DELETE FROM `tasks` WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
        $db->exec($delete);
        header('Location: index.php');
    }
    
    if ($_GET['action'] == 'done') {
        $done = "UPDATE `tasks` SET `is_done`=1 WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
        $db->exec($done);
        header('Location: index.php');
    }
}

//echo '<pre>';
//var_dump($_POST);

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TODO List</title>
    <style>
        table {
            table-layout: auto;
            border: solid 1px gray;
            border-collapse: collapse;
            border-spacing: 0;
        }

        thead {
            background: #dfdfdf;
            text-align: center;
            font-weight: bold;
        }

        td {
            padding: 5px;
            border: solid 1px gray;
        }

        tr:hover {
            background: #eaeaea;
        }

        .done {
            color: green;
        }

        .process {
            color: #cbcb00;
        }
        
        form {
            display: inline-block;
        }
        
        p {
            margin: 0 0 10px 10px;
        }

    </style>
</head>
<body>
<h1>Список дел на сегодня</h1>

<?php
if (array_key_exists('action', $_GET) && $_GET['action'] == 'edit') {
    echo '<form action="index.php?id=' . (int)$_GET['id'] . '" name="edit" method="post">
        <input type="text" name="edit" value="';
    
    $sql = "SELECT * FROM `tasks` WHERE id=" . (int)$_GET['id'];
    $values = $db->query($sql);
    foreach ($values as $value) {
        echo $value['description'];
    }
    
    echo '" > <input type = "submit" value = "Сохранить" ></form>';
} else {
    echo '<form action="index.php" method="post">
            <input type="text" name="add" placeholder="Описание задачи" value=""> <input type="submit" value="Добавить">
          </form>';
}
if (array_key_exists('edit', $_POST)) {
    $edit = "UPDATE tasks SET description='" . strip_tags($_POST['edit']) . "' WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
    $db->exec($edit);
    header('Location: index.php');
} ?>

<form action="index.php" method="post">
<p>Сортировать по:
<select name="list">
    <option value="date">дате обновления</option>
    <option value="done">статусу</option>
    <option value="description">описанию</option>
</select>
    <input type="submit" value="Отсортировать">
</form></p>

<table>
    <thead>
    <tr>
        <td>Описание задачи</td>
        <td>Дата добавления</td>
        <td>Статус</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $rows) : ?>
        <tr>
            <td><?php echo $rows['description'] ?></td>
            <td><?php echo $rows['date_added'] ?></td>
            <td><?= ($rows['is_done'] == 1) ? '<span class="done">Выполнено</span>' : '<span class="process">В процессе</span>' ?></td>
            <td><a href="index.php?action=edit&id=<?= $rows['id'] ?>">Изменить</a>
                <a href="index.php?action=done&id=<?= $rows['id'] ?>">Выполнить</a>
                <a href="index.php?action=delete&id=<?= $rows['id'] ?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>