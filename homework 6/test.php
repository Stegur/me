<?php


$rightAnswerCount = 0;
$wrongAnswerCount = 0;

if (empty($_REQUEST)) {
    echo 'Вы не передали номер теста в GET-апросе через <code>?test=tests</code></br>';
    echo '<a href="test.php?test=tests">Начать тест</a>';
    die();
}


$fileContent = file_get_contents(__DIR__ . "/tests/tests.json") or exit('Неудалось загрузить JSON');
$json = json_decode($fileContent, true);
if ($json == null) {
    exit("Ошибка декодирования JSON");
}


if (!empty($_POST)) {
    foreach ($_POST as $question => $answer) {
        if ($_POST[$question] === $json[$question]['right_answer']) {
            $rightAnswerCount++;
            echo "<p style='color:green'>Вы правильно ответили на вопрос №$question</br>";
            echo $json[$question]['question'] . '</br>';
            echo 'Правильный ответ - ' . $json[$question]['right_answer'] . '</p>';
        } else {
            $wrongAnswerCount++;
            echo "<p style='color:red'>Вы неправильно ответили на вопрос №$question</br>";
            echo $json[$question]['question'] . '</br>';
            echo 'Ваш ответ - ' . $_POST[$question] . '</br>';
            echo 'Правильный ответ - ' . $json[$question]['right_answer'] . '</p>';
        }
        
    }
    echo "Количество верных ответов - $rightAnswerCount </br>";
    echo "Количество неверных ответов - $wrongAnswerCount </br>";
    if ($rightAnswerCount + $wrongAnswerCount != count($json)) {
        echo 'Вы ответили не на все вопросы</br>';
        echo '<a href="test.php?test=test">Повторить?</a></br>';
    } elseif ($wrongAnswerCount == 0) {
        echo 'Поздравляем! Вы превосходно справились с заданием!</br>';
    } elseif ($rightAnswerCount > $wrongAnswerCount) {
        echo 'Поздравляем! Вы хорошо справились с тестом!';
    } else {
        echo 'Вы плохо справились с тестом :( <br>';
        echo '<a href="test.php?test=test">Повторить?</a></br>';
    }
    die();
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
</head>
<body>
<?php
foreach ($json

         as $questionNumber => $question) : ?>
<form action="test.php" method="post">
    <fieldset>
        <legend><b>Вопрос №<?php echo $questionNumber . '</b></br>' . $question['question'] ?></legend>
        <label><input type="radio" name="<?php echo $questionNumber ?>"
                      value="<?php echo $question['answers']['A'] ?>"><?php echo $question['answers']['A'] . '</br>' ?>
        </label>
        <label><input type="radio" name="<?php echo $questionNumber ?>"
                      value="<?php echo $question['answers']['B'] ?>"><?php echo $question['answers']['B'] . '</br>' ?>
        </label>
        <label><input type="radio" name="<?php echo $questionNumber ?>"
                      value="<?php echo $question['answers']['C'] ?>"><?php echo $question['answers']['C'] . '</br>' ?>
        </label>
    </fieldset>
    </br>
    <?php endforeach; ?>

    <input type="submit" value="Отправить ответы">
</form>

<?php //    echo '<pre>';  var_dump($questionNumber); ?>


</body>
</html>