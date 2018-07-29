<?php
$connect = mysqli_connect("localhost", "root", "", "libreria");
// todo проверить на ошибки при пустом запросе

if (!empty($_GET)) {
    if (array_key_exists('isbn', $_GET) || $_GET['isbn'] != NULL || array_key_exists('name', $_GET) || $_GET['name'] != NULL || array_key_exists('author', $_GET) || $_GET['author'] != NULL) {
        $isbn = strip_tags($_GET['isbn']);
        $name = strip_tags($_GET['name']);
        $author = strip_tags($_GET['author']);
        $sql = "SELECT * FROM `books` WHERE isbn LIKE '%{$isbn}%' AND author LIKE '%{$author}%' and name LIKE '%{$name}%'";
    }
} else {
    $sql = "SELECT * from books";
}

if (!$res = mysqli_query($connect, $sql)) {
    echo 'Не правильный запрос';
} else {
    $data = mysqli_fetch_assoc($res);
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>La libreria</title>
    <style>
        table {
            width: 1250px;
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
    </style>
</head>
<body>
<h1>Библиотека успешного человека</h1>

<?php
if (!empty($_GET)) {
    echo "<p><a href=\"index.php\">Отобразить все книги</a></p>";
}
?>

<form action="index.php" method="get">
    <input type="text" placeholder="ISBN" name="isbn" <?= array_key_exists('isbn', $_GET) ? 'value="'.$_GET['isbn'].'"' : 'value=""'?>>
    <input type="text" placeholder="Название книги" name="name" <?= array_key_exists('name', $_GET) ? 'value="'.$_GET['name'].'"' : 'value=""'?>>
    <input type="text" placeholder="Автор книги" name="author" <?= array_key_exists('author', $_GET) ? 'value="'.$_GET['author'].'"' : 'value=""'?>>
    <input type="submit" value="Поиск">
</form>
<br>
<table>
    <thead>
    <tr>
        <td>Название</td>
        <td>Автор</td>
        <td>Год выпуска</td>
        <td>Жанр</td>
        <td>ISBN</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($res as $row) : ?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['author']?></td>
            <td><?php echo $row['year']?></td>
            <td><?php echo $row['genre']?></td>
            <td><?php echo $row['isbn']?></td>
        </tr>
    <?php endforeach;
    if (!$data) {
        echo "По Вашему запросу ничего не найдено. Вы можете уточнить запрос или отобразить все доступные книги<br>";
    }
    ?>
    </tbody>
</table>

</body>
</html>