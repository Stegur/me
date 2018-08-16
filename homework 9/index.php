<?php

class Car                   //Класс без методов
{
    public $brand;
    public $model;
    public $color;
    public $maxSpeed;
    public $fuel;
    
    public function __construct($brand, $model, $color, $maxSpeed, $fuel)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->maxSpeed = $maxSpeed;
        $this->fuel = $fuel;
    }
    
}

class Television            //Класс с методами
{
    public $brand;
    public $color;
    public $diagonal;
    public $matrix;
    
    public function __construct($brand, $color, $diagonal, $matrix)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->diagonal = $diagonal;
        $this->matrix = $matrix;
    }
    
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
    
    public function __construct(string $inkColor, $size, bool $button)
    {
        $this->inkColor = $inkColor;
        $this->size = $size;
        $this->button = $button;
    }
}

class Duck                  //Класс с приватными свойствами
{
    private $name;
    private $color;
    private $location;
    
    public function __construct($name, $color, $location)
    {
        $this->name = $name;
        $this->color = $color;
        $this->location = $location;
    }
    
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
    
    public function __construct($name, $price, $unit) //Не уверен что правильно реализовал подсчет Id для новых продуктов
    {
        $this->name = $name;
        $this->price = $price;
        $this->unit = $unit;
        $this->productId = 1 + self::$count++;
        return $this->productId;
    }
    
}

//////////////////////////////////////////////////////////////////////////

$mercedesX = new Car("Mercedes", "X", "Red", 220, "gas");

$LadaY = new Car("Lda", "Y", "Silver", 180, "diesel");

//echo '<pre>';
//var_dump($mercedesX);
//var_dump($LadaY);

////////////////////////////////////////////////////////////////////////

$myNewTv = new Television("LG", "white", 55.5, "LCD");

$myBrothersTv = new Television("Samsung", "black", 65, "TFT");

//echo '<pre>';
//var_dump($myNewTv);
//var_dump($myBrothersTv);

//////////////////////////////////////////////////////////////////////

$firstPen = new Pen('blue', 'medium', false);

$secondPen = new Pen('red', 'small', true);


//echo '<pre>';
//var_dump($firstPen);
//var_dump($secondPen);

/////////////////////////////////////////////////////////////////////

$daffy = new Duck('Daffy', 'black', 'USA');

$howard = new Duck('Howard', 'white', 'Europe');

//echo '<pre>';
//var_dump($daffy);
//var_dump($howard);

//////////////////////////////////////////////////////////////////////

$iceCream = new Product('Пломбир', 40, 'шт');

$tomatoes = new Product('Помидорки', 100, 'кг');

//echo '<pre>';
//var_dump($iceCream);
//var_dump($tomatoes);
