<?php

$fileContent = file_get_contents(__DIR__ . '/contact.json') or exit("Не удалось загрузить данные");
$json = json_decode($fileContent, true);
//if ($json === null) {
//    exit("Ошибка декодирования JSON");
//}

?>

<!doctype html>
<html lang="ru-en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Возраст</td>
        <td>Адрес</td>
        <td>Электронная почта</td>
        <td>Телефон</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($json as $contact) : ?>

        <tr>
            <td><?php echo $contact['firstName'] ?></td>
            <td><?php echo $contact['lastName'] ?></td>
            <td><?php echo $contact['age'] . ' лет' ?></td>
            <td><?php echo $contact['address'] ?></td>
            <td><a href="mailto:<?php echo $contact['email'] ?>"><?php echo $contact['email'] ?></a></td>
            <td><a href="tel:<?php echo $contact['phoneNumber'] ?>"><?php echo $contact['phoneNumber'] ?></a></td>
        </tr>
    
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

