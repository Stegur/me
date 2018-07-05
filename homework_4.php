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

echo '<pre>';


foreach ($continents as $continent => $animals)
{
    echo '<h2>' . $continent . '</h2>';
    foreach ($animals as $animal)
    {   $twoWordsAnimal = explode(' ', $animal);
        //var_dump($twoWordsAnimal);

        if (count($twoWordsAnimal) == 2){                   //исключил 'Panthera tigris tigris', у которого 3 слова
            echo  $animal . '<br/>';
        }
    }
}



