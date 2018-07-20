<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<div>
    Список доступных тестов:<br>
</div>
<?php
$files = scandir(__DIR__ . '/tests/');
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $testName = substr($file, 0, -5);
        $link = "<a href=\"test.php?test=$testName\">$testName</a>";
        echo $link . '</br>';
    }
}
?>

</body>
</html>