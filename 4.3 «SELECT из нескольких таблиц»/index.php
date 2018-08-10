<?php

require_once 'core/db_enter.php';

if (empty($_SESSION)) {
    echo '<a href="core/register.php">Войдите на сайт</a>';
    die();
}

if (array_key_exists('add', $_POST)) {
    $add = "INSERT INTO task(`id`, `user_id`, `assigned_user_id`, `description`, `is_done`, `date_added`) VALUES (null,{$_SESSION['id']},{$_SESSION['id']},'" . strip_tags($_POST['add']) . "',0,CURRENT_TIMESTAMP)";
    $db->exec($add);
    header('Location: index.php');
}
if (array_key_exists('action', $_GET)) {
    if ($_GET['action'] == 'delete') {
        $delete = "DELETE FROM task WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
        $db->exec($delete);
        header('Location: index.php');
    }
    
    if ($_GET['action'] == 'done') {
        $done = "UPDATE task SET `is_done`=1 WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
        $db->exec($done);
        header('Location: index.php');
    }
}

if (array_key_exists('assign', $_POST)) {
    $assign = "UPDATE task SET assigned_user_id=" . $_POST['assigned_user'] . " WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
    $db->exec($assign);
    header('Location: index.php');
}


//echo '<pre>';
//var_dump($_POST);
//var_dump($_GET);
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

<?php
echo "<h1>Здравствуйте, {$_SESSION['login']}! Вот ваш список дел:</h1><br>";

if (array_key_exists('action', $_GET) && $_GET['action'] == 'edit') {
    echo '<form action="index.php?id=' . (int)$_GET['id'] . '" name="edit" method="post">
        <input type="text" name="edit" value="';
    
    $sql = "SELECT * FROM task WHERE id=" . (int)$_GET['id'];
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
    $edit = "UPDATE task SET description='" . strip_tags($_POST['edit']) . "' WHERE id=" . (int)$_GET['id'] . " LIMIT 1";
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
</form>
</p>

<table>
    <thead>
    <tr>
        <td>Описание задачи</td>
        <td>Дата добавления</td>
        <td>Статус</td>
        <td></td>
        <td>Ответственный</td>
        <td>Автор</td>
        <td>Закрепить задачу</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task) : ?>
        <tr>
            <td><?php echo $task['description'] ?></td>
            <td><?php echo $task['date_added'] ?></td>
            <td><?= ($task['is_done'] == 1) ? '<span class="done">Выполнено</span>' : '<span class="process">В процессе</span>' ?></td>
            <td><a href="index.php?action=edit&id=<?= $task['id'] ?>">Изменить</a>
                <a href="index.php?action=done&id=<?= $task['id'] ?>">Выполнить</a>
                <a href="index.php?action=delete&id=<?= $task['id'] ?>">Удалить</a>
                <!--           todo      если не ответственный убрать кнопку выполнить-->
            </td>
            <td><?= ($task['assigned_user_id'] == $_SESSION['id']) ? 'Вы' : $task['assigned_user_id'] ?></td>
            <td><?= ($task['assigned_user_id'] == $_SESSION['id']) ? 'Вы' : $task['assigned_user_id'] ?></td>
            <td>
                <form action="index.php?id=<?= $task['id'] ?>" method="post">
                    <select name="assigned_user">
                        <?php
                        $sql = "SELECT * FROM user";
                        $users = $db->query($sql);
                        foreach ($users as $user) : ?>
                            <option value="<?= $user['id'] ?>">
                                <?= $user['login'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="Переложить ответственность" name="assign">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<p><b>Также, посмотрите, что от Вас требуют другие люди:</b></p>

<table>
    <thead>
    <tr>
        <td>Описание задачи</td>
        <td>Дата добавленея</td>
        <td>Статус</td>
        <td></td>
        <td>Ответственный</td>
        <td>Автор</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM task WHERE assigned_user_id='" . $_SESSION['id'] . "'";
    $usersTasks = $db->query($sql);
    foreach ($usersTasks as $task) : ?>

        <tr>
            <td><?php echo $task['description'] ?></td>
            <td><?php echo $task['date_added'] ?></td>
            <td><?= ($task['is_done'] == 1) ? '<span class="done">Выполнено</span>' : '<span class="process">В процессе</span>' ?></td>
            <td><a href="index.php?action=edit&id=<?= $task['id'] ?>">Изменить</a>
                <a href="index.php?action=done&id=<?= $task['id'] ?>">Выполнить</a>
                <a href="index.php?action=delete&id=<?= $task['id'] ?>">Удалить</a>
                <!--           todo      если не ответственный убрать кнопку выполнить-->
            </td>
            <td><?= ($task['assigned_user_id'] == $_SESSION['id']) ? 'Вы' : $task['assigned_user_id'] ?></td>
            <td><?= ($task['assigned_user_id'] == $_SESSION['id']) ? 'Вы' : $task['assigned_user_id'] ?></td>
        </tr>
    
    <?php endforeach; ?>

    </tbody>
</table>
<br>
<div><a href="core/logout.php">Выход</a></div>
</body>
</html>