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


foreach ($continents as $continent => $animals)
{
    foreach ($animals as $animal)
    {
        $twoWordsAnimal = explode(' ', $animal);

        if (count($twoWordsAnimal) == 2){                   //исключил 'Panthera tigris tigris', у которого 3 слова
            $secondWordArray [] = $twoWordsAnimal[1];
            shuffle($secondWordArray);
            $firstWordArray [] = $twoWordsAnimal[0];
            //shuffle($firstWordArray);
        }
    }
}



echo '<h2>Europe</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Genetta' or $firstWordArray [$i] == 'Balaenoptera' or $firstWordArray [$i] == 'Alces')
    {
        echo $firstWordArray [$i] . ' ' . $secondWordArray [$i] .'<br/>';
        }
}

echo '<h2>Asia</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Naemorhedus' or $firstWordArray [$i] == 'Elephas')
    {
        echo $firstWordArray [$i] . ' ' . $secondWordArray [$i] .'<br/>';
    }
}

echo '<h2>Antarctica</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Pygoscelis' or $firstWordArray [$i] == 'Leptonychotes')
    {
        echo $firstWordArray [$i] . ' ' . $secondWordArray [$i] .'<br/>';
    }
}

echo '<h2>North America</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Rangifer' or $firstWordArray [$i] == 'Lepus' or $firstWordArray [$i] == 'Gulo')
    {
        echo $firstWordArray [$i] . ' ' . $secondWordArray [$i] .'<br/>';
    }
}

echo '<h2>South America</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Hydrochoerus' or $firstWordArray [$i] == 'Furipterus')
    {
        echo $firstWordArray [$i] . ' ' . $secondWordArray [$i] .'<br/>';
    }
}

echo '<h2>Australia</h2>';
for ($i = 0; $i < count($firstWordArray); $i++)
{
    if($firstWordArray [$i] == 'Ornithorhynchus' or $firstWordArray [$i] == 'Phascolarctos')
    {
        $result = $firstWordArray [$i] . ' ' . $secondWordArray [$i] . '<br/>';
        echo $result;
    }
}








