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
    <title>Тесты</title>
</head>
<body>
<?php if (!empty($_GET['test'])) {
    echo '<div>Вопрос №' . $_GET['test'] . '</br></div>';
}

if (empty($_REQUEST)) {
    echo '<div>Выберите тест: </br>';
    foreach ($json as $number => $values) {
        echo "<a href=\"test.php?test=$number\">Вопрос №$number</a> ";
    }
    echo '</div>';
    exit();
}

if (!empty($_POST)) {
    for ($i = 1; $i <= count($json); $i++) {
        if ($_POST['answer'] === $json[$i]['right_answer']) {
            echo 'Вы верно ответили на вопрос!</br> Выберите другой: </br>';
        } else {
            echo 'Вы дали неверный ответ, повторите тест! </br>';
            echo "<a href=\"test.php?test=$i\">Повторить тест №$i</a> ";
            echo '</br>';
//            echo '<pre>';
//            var_dump($_POST['answer']);
//            var_dump($json[$i]['right_answer']);
            break;
        }
    }
    foreach ($json as $number => $values) {
        echo '</br>';
        echo "<a href=\"test.php?test=$number\">Вопрос №$number</a> ";
    }
    exit();
}


echo $json[$_GET['test']]['question'] . '</br></br>';
echo 'Варианты ответов:' . '</br></br>';
echo '<b>A.</b> ' . $json[$_GET['test']]['answers']['A'] . '</br>';
echo '<b>B.</b> ' . $json[$_GET['test']]['answers']['B'] . '</br>';
echo '<b>C.</b> ' . $json[$_GET['test']]['answers']['C'] . '</br></br>';
echo 'Скопируйте ответ (после буквы с точкой) в поле ниже и нажмите "Отправить"</br></br>';
?>

<form action="test.php" method="post">
    <div><input type="text" name="answer" placeholder="Ответ"></br></br></div>
    <div><input type="submit" value="Отправить"></div>
</form>
</br>

<div>
    <?php
    foreach ($json as $number => $values) {
        echo "<a href=\"test.php?test=$number\">Вопрос №$number</a> ";
    }
    ?>
</div>
</body>
</html>
