<?

interface SuperInterface
{

    public function __construct($title, $price);
    
    public function getDescription();
    
    public function getTitle();
    
    public function getPrice();
}

abstract class SuperClass implements SuperInterface
{
    protected $title;
    protected $price;
    
    public function __construct($title, $price)
    {
        $this->title = $title;
        $this->price = $price;
    }
    
    public function getDescription()
    {
    
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
}

interface CarTemplate
{
    public function getDescription();
}

class Car extends SuperClass implements CarTemplate
{
    public $brand;
    public $model;
    public $color;
    public $maxSpeed;
    public $fuel;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
}

interface TelevisionTemplate
{
    public function getDescription();
    public function setColor(string $color);
    public function setDiagonal(float $diagonal);
}

class Television extends SuperClass implements TelevisionTemplate
{
    public $brand;
    public $color;
    public $diagonal;
    public $matrix;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
    public function setColor(string $color)
    {
        $this->color = $color;
    }
    
    public function setDiagonal(float $diagonal)
    {
        $this->diagonal = $diagonal;
    }
}

interface PenTemplate
{
    public function getDescription();
    public function getInkColor(): string;
    public function getButton(): bool;
    public function getSize(): string;
}

class Pen extends SuperClass implements PenTemplate
{
    public $inkColor;
    public $size = 'medium';
    public $button;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
    public function getInkColor(): string
    {
        return $this->inkColor;
    }

    public function getButton(): bool
    {
        return $this->button;
    }
    
    public function getSize(): string
    {
        return $this->size;
    }
}

interface DuckTemplate
{
    public function getDescription();
    public function setName(string $name);
    public function setColor(string $color);
    public function setLocation(string $location);
    
}

class Duck extends SuperClass implements DuckTemplate
{
    private $name;
    private $color;
    private $location;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function setColor(string $color)
    {
        $this->color = $color;
        return $this;
    }
    
    public function setLocation(string $location)
    {
        $this->location = $location;
        return $this;
    }
    
}

interface ProductTemplate
{
    const CONST = 'Новый товар';
    public function getDescription();
    public function count();
}

class Product extends SuperClass implements ProductTemplate
{
    public $unit;
    public $productId;
    public static $count = 0;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
    public function count() //Не уверен что правильно реализовал подсчет Id для новых продуктов
    {
        $this->productId = 1 + self::$count++;
        return $this->productId;
    }
    
}

//////////////////////////////////////////////////////////////////////////

$mercedesX = new Car('My First Car', 10000);
$mercedesX->brand = 'Mercedes';
$mercedesX->model = 'X';
$mercedesX->color = 'Red';
$mercedesX->maxSpeed = '220';
$mercedesX->fuel = 'gas';

$LadaY = new Car('My Current Car', 2000);
$LadaY->brand = 'Lada';
$LadaY->model = 'Y';
$LadaY->color = 'Silver';
$LadaY->maxSpeed = '180';
$LadaY->fuel = 'diesel';

//echo '<pre>';
//var_dump($mercedesX);
//var_dump($LadaY);

////////////////////////////////////////////////////////////////////////

$myNewTv = new Television('My First TV', 100);
$myNewTv->brand = 'LG';
$myNewTv->color = 'white';
$myNewTv->setDiagonal('55.5');
$myNewTv->matrix = 'LCD';

$myBrothersTv = new Television('My Current TV', 5000);
$myBrothersTv->brand = 'Samsung';
$myBrothersTv->setDiagonal('65');
$myBrothersTv->matrix = 'TFT';

//echo '<pre>';
//var_dump($myNewTv);
//var_dump($myBrothersTv);

//////////////////////////////////////////////////////////////////////

$firstPen = new Pen('Best Pen', 100);
$firstPen->inkColor = 'Blue';
$firstPen->button = true;

$secondPen = new Pen('Worse pen', 10);
$secondPen->size = 'small';
$secondPen->inkColor = 'Red';
$secondPen->button = false;

//echo '<pre>';
//var_dump($firstPen);
//var_dump($secondPen);

/////////////////////////////////////////////////////////////////////

$daffy = new Duck('My First Duck', 0);
$daffy->setName('Daffy');
$daffy->setColor('black');
$daffy->setLocation('USA');

$howard = new Duck('My Current Duck', 0);
$howard->setName('Howard');
$howard->setColor('white');
$howard->setLocation('Europe');

//echo '<pre>';
//var_dump($daffy);
//var_dump($howard);

//////////////////////////////////////////////////////////////////////

$iceCream = new Product('Something old', 10);
$iceCream->name = 'Пломбир';
$iceCream->unit = 'шт';
$iceCream->count();

$tomatoes = new Product('Something new', 15);
$tomatoes->name = 'Помидорки';
$tomatoes->unit = 'кг';
$tomatoes->count();

//echo '<pre>';
//var_dump($iceCream);
//var_dump($tomatoes);
