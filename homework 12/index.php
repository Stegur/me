<?php
$connect = mysqli_connect("localhost", "root", "", "libreria");

// TODO опробовать перебрать Case

if (array_key_exists('isbn', $_GET ) && $_GET['isbn'] != NULL) {
    $isbn = strip_tags($_GET['isbn']);
    $sql = "SELECT * FROM books WHERE isbn='{$isbn}'";
} elseif (array_key_exists('name', $_GET) && $_GET['name'] != NULL) {
    $name = strip_tags($_GET['name']);
    $sql = "SELECT * FROM books WHERE name LIKE '%{$name}%'";
} elseif (array_key_exists('author', $_GET) && $_GET['author'] != NULL) {
    $author = strip_tags($_GET['author']);                  //todo striptags()
    $sql = "SELECT * FROM books WHERE author LIKE '%{$author}%'";
} else {
    $sql = "SELECT * from books";
}

if (!$res = mysqli_query($connect, $sql)) {
    echo 'Не правильный запрос';
} else {
    $data = mysqli_fetch_assoc($res);
}
//strip_tags()
//echo "<pre>";
//var_dump($author);
//var_dump($name);
//var_dump($isbn);

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
<form action="index.php" method="get">
    <input type="text" placeholder="ISBN" name="isbn">
    <input type="text" placeholder="Название книги" name="name">
    <input type="text" placeholder="Автор книги" name="author">
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
        echo "По Вашему запросу ничего не найдено. Вы можете уточнить запрос или обобразить все доступные книги<br>";
        echo "<a href='index.php'>Отобразить?</a><br>";
    }
    ?>
    </tbody>
</table>

</body>
</html>