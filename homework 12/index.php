<?php
$connect = mysqli_connect("localhost","root", "", "libreria");
$sql = "SELECT * from books";

$res = mysqli_query($connect, $sql);
$data = mysqli_fetch_assoc($res);

//foreach ($res as $rows) {
//    echo '<pre>';
//
//    var_dump($rows);

//}

//var_dump($res);
//var_dump($data);
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
            padding: 3px;
            border: solid 1px gray;
        }
    </style>
</head>
<body>
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
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>