<?

interface SuperInterface
{
    
    public function getDescription();
    
    public function getTitle();
    
    public function getPrice();
}

abstract class SuperClass implements SuperInterface
{
    protected $title;
    protected $price;
    
    
    public function getDescription()
    {
        echo 'Текст от наследуемого элемента';
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
    
    public function __construct($brand, $model, $color, $maxSpeed, $fuel)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->maxSpeed = $maxSpeed;
        $this->fuel = $fuel;
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
    
    public function __construct($brand, $color, $diagonal, $matrix)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->diagonal = $diagonal;
        $this->matrix = $matrix;
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
    
    public function __construct(string $inkColor, $size, bool $button)
    {
        $this->inkColor = $inkColor;
        $this->size = $size;
        $this->button = $button;
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
    
    public function __construct($name, $color, $location)
    {
        $this->name = $name;
        $this->color = $color;
        $this->location = $location;
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
}

class Product extends SuperClass implements ProductTemplate
{
    public $unit;
    public $productId;
    public static $count;
    
    public function getDescription()
    {
        parent::getDescription();
    }
    
    public function __construct($title, $price, $unit, $count = 0) //Не уверен что правильно реализовал подсчет Id для новых продуктов
    {
        $this->title = $title;
        $this->price = $price;
        $this->unit = $unit;
        $this->productId = 1 + self::$count++;
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
