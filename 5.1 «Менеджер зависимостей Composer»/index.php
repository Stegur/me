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
    <style>
    .style {
        display: inline-block;
    }
    </style>
    <title>My map</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map-ya", {
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

        function initMap() {
            var myLatLng = {lat: <?= (float)strip_tags($_GET['latitude']) ?>, lng: <?= (float)strip_tags($_GET['longitude']) ?>};

            // Create a map object and specify the DOM element
            // for display.
            var map = new google.maps.Map(document.getElementById('map-google'), {
                center: myLatLng,
                zoom: 9
            });

            // Create a marker and set its position.
            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: '<?= (string)strip_tags($_GET['name']) ?>'
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=netology-geo&callback=initMap"
            async defer></script>
</head>
<body>

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
} else {
    echo '<form action="index.php" method="post">
    <p>Введите запрос:</p>
    <input type="text" name="address" placeholder="введите адрес"> <input type="submit" value="Найти">
</form>';
}
if (array_key_exists('latitude', $_GET) && array_key_exists('latitude', $_GET)) {
    echo '<div class="style" id="map-ya" style="width: 600px; height: 400px"></div>';
    echo "<div class=\"style\" id='printoutPanel'></div>";
    echo "<div class=\"style\" id='myMap' style='width: 600px; height: 400px;'></div>";
    echo '<div class="style" id="map-google" style="width: 600px; height: 400px"></div>';
}
?>
<script type='text/javascript'>
    function loadMapScenario() {
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            /* No need to set credentials if already passed in URL */
            center: new Microsoft.Maps.Location(<?= (float)strip_tags($_GET['latitude']) ?>, <?= (float)strip_tags($_GET['longitude']) ?>),
            mapTypeId: Microsoft.Maps.MapTypeId.aerial,
            zoom: 9 });

    }
</script>
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=YourBingMapsKey&callback=loadMapScenario' async defer></script>
</body>
</html>