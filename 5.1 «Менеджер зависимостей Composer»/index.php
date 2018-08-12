<?php
require __DIR__ . '/vendor/autoload.php';

$api = new \Yandex\Geo\Api();

if (array_key_exists('address', $_POST)) {
    $address = (string)strip_tags($_POST['address']);
    $api->setQuery($address);
    $api->setLimit(10);
    $api->setLang(\Yandex\Geo\Api::LANG_RU);
    $api->load();
    
    $response = $api->getResponse();
    
    $list = $response->getList();
    
}


//echo '<pre>';
//var_dump($_GET);



?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>My map</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [<?= (float)strip_tags($_GET['latitude']) ?>, <?= (float)strip_tags($_GET['longitude']) ?>],
                zoom: 9
            });

            var myPlacemark = new ymaps.Placemark([<?= (float)strip_tags($_GET['latitude']) ?>, <?= (float)strip_tags($_GET['longitude']) ?>], {
                // Хинт показывается при наведении мышкой на иконку метки.
                hintContent: '<?= (string)strip_tags($_GET['name']) ?>',
                // Балун откроется при клике по метке.
                //balloonContent: 'Содержимое балуна'
            });

            // После того как метка была создана, ее
            // можно добавить на карту.
            myMap.geoObjects.add(myPlacemark);
        }
    </script>
</head>
<body>
<form action="index.php" method="post">
    <p>Введите запрос:</p>
    <input type="text" name="address" placeholder="введите адрес"> <input type="submit" value="Найти">
</form>
<br>
<?php
if ($list) {
    echo "<p>По Вашему запросу \"{$_POST['address']}\" найдены следующие совпадения:</p>";
    foreach ($list as $item) {
        $name = $item->getAddress();
        $latitude = $item->getLatitude();
        $longitude = $item->getLongitude();
        echo "<a href='index.php?name={$name}&latitude={$latitude}&longitude={$longitude}'>{$name}</a><br>";
    }
}
if (array_key_exists('latitude',$_GET) && array_key_exists('latitude',$_GET)) {
    echo '<div id="map" style="width: 600px; height: 400px"></div>';
}
?>



</body>
</html>