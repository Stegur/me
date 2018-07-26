<?php

class Car                   //Класс без методов
{
    public $brand;
    public $model;
    public $color;
    public $maxSpeed;
    public $fuel;
    
}

class Television            //Класс с методами
{
    public $brand;
    public $color;
    public $diagonal;
    public $matrix;
    
    
    public function getColor(): string
    {
        $this->color = 'black';
        return $this->color;
    }
    
    public function setDiagonal(float $diagonal)
    {
        $this->diagonal = $diagonal;
    }
}

class Pen                   //Класс с конструктором
{
    public $inkColor;
    public $size = 'medium';
    public $button;
    
    public function __construct(string $inkColor, bool $button)
    {
        $this->inkColor = $inkColor;
        $this->button = $button;
    }
}

class Duck                  //Класс с приватными свойствами
{
    private $name;
    private $color;
    private $location;
    
    public function setName(string $name)
    {
        $this->name = $name;
    }
    
    public function setColor(string $color)
    {
        $this->color = $color;
    }
    
    public function setLocation(string $location)
    {
        $this->location = $location;
    }
    
}

class Product               //Класс с константой и статическим свойством
{
    public $name;
    public $price;
    public $unit;
    public $productId;
    public static $count = 0;
    const CONST = 'Новый товар';
    
    public function __construct() //Не уверен что правильно реализовал подсчет Id для новых продуктов
    {
        $this->productId = 1 + self::$count++;
        return $this->productId;
    }
    
}

//////////////////////////////////////////////////////////////////////////

$mercedesX = new Car();
$mercedesX->brand = 'Mercedes';
$mercedesX->model = 'X';
$mercedesX->color = 'Red';
$mercedesX->maxSpeed = '220';
$mercedesX->fuel = 'gas';

$LadaY = new Car();
$LadaY->brand = 'Lada';
$LadaY->model = 'Y';
$LadaY->color = 'Silver';
$LadaY->maxSpeed = '180';
$LadaY->fuel = 'diesel';

//echo '<pre>';
//var_dump($mercedesX);
//var_dump($LadaY);

////////////////////////////////////////////////////////////////////////

$myNewTv = new Television();
$myNewTv->brand = 'LG';
$myNewTv->color = 'white';
$myNewTv->setDiagonal('55.5');
$myNewTv->matrix = 'LCD';

$myBrothersTv = new Television();
$myBrothersTv->brand = 'Samsung';
$myBrothersTv->getColor();
$myBrothersTv->setDiagonal('65');
$myBrothersTv->matrix = 'TFT';

//echo '<pre>';
//var_dump($myNewTv);
//var_dump($myBrothersTv);

//////////////////////////////////////////////////////////////////////

$firstPen = new Pen('blue', false);

$secondPen = new Pen('red', true);
$secondPen->size = 'small';

//echo '<pre>';
//var_dump($firstPen);
//var_dump($secondPen);

/////////////////////////////////////////////////////////////////////

$daffy = new Duck();
$daffy->setName('Daffy');
$daffy->setColor('black');
$daffy->setLocation('USA');

$howard = new Duck();
$howard->setName('Howard');
$howard->setColor('white');
$howard->setLocation('Europe');

//echo '<pre>';
//var_dump($daffy);
//var_dump($howard);

//////////////////////////////////////////////////////////////////////

$iceCream = new Product();
$iceCream->name = 'Пломбир';
$iceCream->price = '40';
$iceCream->unit = 'шт';

$tomatoes = new Product();
$tomatoes->name = 'Помидорки';
$tomatoes->price = '100';
$tomatoes->unit = 'кг';

//echo '<pre>';
//var_dump($iceCream);
//var_dump($tomatoes);
