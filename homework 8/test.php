<?php
require_once __DIR__ . '/functions.php';

if (empty($_REQUEST)) {
    echo 'Вы не передали номер теста в GET-апросе через <code>?test=testName</code></br>';
    die();
}

if (array_key_exists('test', $_GET)) {
    $testName = __DIR__ . "/tests/{$_GET['test']}.json";
    if (!file_exists($testName)) {
        http_response_code(404);
        die();
    } else {
        $fileContent = file_get_contents(__DIR__ . "/tests/{$_GET['test']}.json");
        $json = json_decode($fileContent, true);
        if ($json == null) {
            exit("Ошибка декодирования JSON");
        }
    }
}

if (!empty($_SESSION)) {
    echo "<div><a href='logout.php'>Выйти из сессии</a></div>";
} else {
    header('Location: index.php');
}

$rightAnswerCount = 0;
$wrongAnswerCount = 0;

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
        echo '<a href="test.php?test=' . $_GET['test'] . '">Повторить?</a></br>';
    } elseif ($wrongAnswerCount == 0) {
        echo 'Поздравляем! Вы превосходно справились с заданием!</br>';
        echo '<a href="certificate.php?count=' . $rightAnswerCount . '">Получить сертификат</a></br>';
    } elseif ($rightAnswerCount > $wrongAnswerCount) {
        echo 'Поздравляем! Вы хорошо справились с тестом!</br>';
        echo '<a href="certificate.php?count=' . $rightAnswerCount . '">Получить сертификат</a></br>';
    } else {
        echo 'Вы плохо справились с тестом :( <br>';
        echo '<a href="test.php?test=' . $_GET['test'] . '">Повторить?</a></br>';
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
<?php foreach ($json as $questionNumber => $question) : ?>
<form action="test.php?test=<?php echo $_GET['test'] ?>" method="post">
    <fieldset>
        <legend><b>Вопрос №<?php echo $questionNumber . '</b></br>' . $question['question'] ?></legend>
        <?php for ($i = 1;
        $i <= count($question['answers'], COUNT_RECURSIVE);
        $i++) : ?>
        <label><input type="radio" name="<?php echo $questionNumber ?>"
                      value="<?php echo $question['answers'][$i] ?>"><?php echo $question['answers'][$i] . '<br>' ?>
            
            <?php endfor; ?>
    </fieldset>
    <br>
    <?php endforeach; ?>
    <input type="submit" value="Отправить ответы">
</form>
<?php if (array_key_exists('user', $_SESSION)) : ?>
    <p><a href="admin.php">Перейти к загрузке тестов</a></p>
<?php endif; ?>
<p><a href="list.php">Перейти к списку тестов</a></p>

</body>
</html>