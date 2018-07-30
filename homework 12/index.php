<?php
$connect = mysqli_connect("localhost", "root", "", "libreria");

if (!empty($_GET)) {
    if (array_key_exists('isbn', $_GET) || $_GET['isbn'] ||
        array_key_exists('name', $_GET) || $_GET['name'] ||
        array_key_exists('author', $_GET) || $_GET['author'] ||
        array_key_exists('genre', $_GET) || $_GET['genre'] ||
        array_key_exists('year', $_GET) || $_GET['year']) {
        $isbn = strip_tags($_GET['isbn']);
        $name = strip_tags($_GET['name']);
        $author = strip_tags($_GET['author']);
        $genre = strip_tags($_GET['genre']);
        $year = strip_tags($_GET['year']);
        $sql = "SELECT * FROM `books` WHERE isbn LIKE '%{$isbn}%' AND author LIKE '%{$author}%' and name LIKE '%{$name}%' and year LIKE '%{$year}%' and genre LIKE '%{$genre}%'";
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

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
<h1>Библиотека успешного человека</h1>

<?php
if (!empty($_GET)) {
    echo "<p><button><a href=\"index.php\">Отобразить все книги</a></button></p>";
}
?>

<form action="index.php" method="get">
    <input type="text" placeholder="ISBN"
           name="isbn" <?= array_key_exists('isbn', $_GET) ? 'value="' . $_GET['isbn'] . '"' : 'value=""' ?>>
    <input type="text" placeholder="Название книги"
           name="name" <?= array_key_exists('name', $_GET) ? 'value="' . $_GET['name'] . '"' : 'value=""' ?>>
    <input type="text" placeholder="Автор книги"
           name="author" <?= array_key_exists('author', $_GET) ? 'value="' . $_GET['author'] . '"' : 'value=""' ?>>
    <input type="text" placeholder="Жанр"
           name="genre" <?= array_key_exists('genre', $_GET) ? 'value="' . $_GET['genre'] . '"' : 'value=""' ?>>
    <input type="text" placeholder="Год выпуска"
           name="year" <?= array_key_exists('year', $_GET) ? 'value="' . $_GET['year'] . '"' : 'value=""' ?>>
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
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['author'] ?></td>
            <td><?php echo $row['year'] ?></td>
            <td><?php echo $row['genre'] ?></td>
            <td><?php echo $row['isbn'] ?></td>
        </tr>
    <?php endforeach;
    if (!$data) {
        echo "<p>По Вашему запросу ничего не найдено. Вы можете уточнить запрос или отобразить все доступные книги</p>";
    }
    ?>
    </tbody>
</table>

</body>
</html>