<?php

$x = rand(0,100);
//$x = 90;
echo $x."<br/>";

$a = 1;
$b = 1;

//if ($a > $x){
//    echo "Задуманное число не входит в цифровой ряд";
//}elseif ($a == $x){
//    echo "Задуманное число входит в цифровой ряд";
//}else {
//    while ($a < $x) {
//        $c = $a;
//        $a += $b;
//        $b = $c;
//        echo $c . "<br/>";
//    }
//}

while (true){
    if ($a > $x){
        echo "<p style='color: red'>Задуманное число не входит в цифровой ряд</p>";
        break;
    }elseif ($a == $x) {
        echo "<p style='color: green'>Задуманное число входит в цифровой ряд</p>";
        break;
    }else {
        $c = $a;
        $a += $b;
        $b = $c;
        //echo $c . "<br/>";
    }
}
?>