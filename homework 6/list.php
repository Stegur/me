<?php
$fileContent = file_get_contents(__DIR__ . '/tests/tests.json') or exit('Неудалось загрузить JSON');
$json = json_decode($fileContent, true);
if ($json == null) {
    exit("Ошибка декодирования JSON");
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<?php
foreach ($json as $number => $values) {
    echo "<div>Вопрос №$number</div>";
    echo '<div>' . $values['question'] . '</div>';
    echo '<p>Варианты ответов: </p>';
    echo '<p><b>A. </b>' . $values['answers']['A'] . '</br>';
    echo '<b>B. </b>' . $values['answers']['B'] . '</br>';
    echo '<b>C. </b>' . $values['answers']['C'] . '</br>';
    echo '<i>Правильный ответ: ' . $values['right_answer'] . '</i></br><hr></p>';
}
?>

</body>
</html>
