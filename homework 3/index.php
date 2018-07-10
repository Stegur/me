<?php

$continents = [
    'Africa' => ['Giraffa', 'Hippopotamus', 'Hippotigris'],
    'Europe' => ['Genetta genetta', 'Balaenoptera edeni', 'Alces alces'],
    'Asia' => ['Panthera tigris tigris', 'Naemorhedus goral', 'Elephas maximus'],
    'Antarctica' => ['Pygoscelis antarctica', 'Leptonychotes weddellii'],
    'North America' => ['Rangifer tarandus', 'Lepus arcticus', 'Gulo gulo'],
    'South America' => ['Hydrochoerus hydrochaeris', 'Furipterus horrens'],
    'Australia' => ['Ornithorhynchus anatinus', 'Phascolarctos cinereus', 'Tachyglossidae'],
];

$secondWordArray = [];
$firstWordArray = [];
$animalArray = [];

foreach ($continents as $continent => $animals)
{
    foreach ($animals as $animal)
    {
        $twoWordsAnimal = explode(' ', $animal);
        if (count($twoWordsAnimal) == 2){                   //исключил 'Panthera tigris tigris', у которого 3 слова
            $secondWordArray [] = $twoWordsAnimal[1];
            $firstWordArray [] = $twoWordsAnimal[0];
            $animalArray[$continent][] = $twoWordsAnimal[0];
        }
    }
}
shuffle($secondWordArray);

foreach ($animalArray as $continent => $animal){
    for ($i = 0; $i < count($firstWordArray); $i++){
        if (in_array($firstWordArray[$i], $animal)){
            $newAnimals[$continent][] = $firstWordArray[$i] . ' ' . $secondWordArray[$i];
        }
    }
    $newAnimal = implode(', ', $newAnimals[$continent]);
    echo '<h2>' . $continent . '</h2>';
    echo $newAnimal;
}