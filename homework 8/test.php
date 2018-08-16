<?php
require_once __DIR__ . '/core/functions.php';

if (empty($_REQUEST)) {
    echo 'Вы не передали номер теста в GET-апросе через <code>?test=testName</code></br>';
    die();
}

if (array_key_exists('test', $_GET)) {
    $testName = __DIR__ . "/tests/{$_GET['test']}.json";
    if (!file_exists($testName)) {
        http_response_code(404);
        die('404 Not Found');
    } else {
        $fileContent = file_get_contents(__DIR__ . "/tests/{$_GET['test']}.json");
        $json = json_decode($fileContent, true);
        if ($json == null) {
            exit("Ошибка декодирования JSON");
        }
    }
}


$rightAnswerCount = 0;
$wrongAnswerCount = 0;


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
</head>
<body>

<?php

if (!empty($_SESSION)) {
    echo "<div><a href='core/logout.php'>Выйти из сессии</a></div>";
} else {
    header('Location: index.php');
}

if (array_key_exists('user', $_SESSION)) : ?>
    <p><a href="admin.php">Перейти к загрузке тестов</a></p>
<?php endif; ?>
<p><a href="list.php">Перейти к списку тестов</a></p>

<?php
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
        echo '<img src="core/certificate.php?count=' . $rightAnswerCount . '" alt="Сертификат"></br>';
    } elseif ($rightAnswerCount > $wrongAnswerCount) {
        echo 'Поздравляем! Вы хорошо справились с тестом!</br>';
        echo '<img src="core/certificate.php?count=' . $rightAnswerCount . '" alt="Сертификат"></br>';
    } else {
        echo 'Вы плохо справились с тестом :( <br>';
        echo '<a href="test.php?test=' . $_GET['test'] . '">Повторить?</a></br>';
    }
} else {
    
    
    echo '<form action="test.php?test=' . $_GET['test'] . '" method="post">';
    
    foreach ($json as $questionNumber => $question) {
         echo   '<fieldset><legend><b>Вопрос №' . $questionNumber . '</b></br>' . $question['question'] . '</legend>';
        for ($i = 1; $i <= count($question['answers'], COUNT_RECURSIVE); $i++) {
            echo '<label><input type="radio" name="' . $questionNumber . '" value="' . $question['answers'][$i] . '">' . $question['answers'][$i] . '<br>';
            
        }
        echo '</fieldset><br>';
    }
    echo '<input type="submit" value="Отправить ответы">';
    echo '</form>';
}

?>
</body>
</html>