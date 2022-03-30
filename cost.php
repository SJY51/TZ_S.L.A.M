<?php
include_once "db.php";
class Pizza
{

    public $db;

    public $pizzaId;
    public $sizeId;

    public $sauce;
    public $pizzaName;
    public $sizeName;

    public $pizzaPrice;
    public $saucePrice;
    public $totalPrice;

    function __construct($db, $pizzaId, $sizeId, $sauce)
    {
        $this->db = $db;
        $this->pizzaId = $pizzaId;
        $this->sizeId = $sizeId;
        $this->sauce = $sauce;
        $result = $this->db->query("SELECT pizza from pizzas WHERE id = '{$this->pizzaId}'");
        $this->pizzaName = $result[0]['pizza'];
        $result = $this->db->query("SELECT size from sizes WHERE id_size = '{$this->sizeId}'");
        $this->sizeName = $result[0]['size'];

        $this->pizzaPrice = $this->getPizzaPrice();
        $this->saucePrice = $this->getSaucePrice();
        $this->totalPrice = $this->getTotalPrice();
    }

    public function getPizzaPrice()
    {
        $pizzaPrice = $this->db->query("SELECT price FROM sizes
        LEFT JOIN pizzas ON pizzas.id=sizes.id_pizza 
        WHERE pizzas.id='{$this->pizzaId}'  and sizes.id_size='{$this->sizeId}'");
        $pizzaPrice = isset($pizzaPrice[0]['price']) ? $pizzaPrice[0]['price'] : 0;

        return $pizzaPrice;
    }

    public function getSaucePrice()
    {
        $saucePrice = $this->db->query("SELECT price FROM sauces WHERE sauce = '{$this->sauce}'");
        $saucePrice = isset($saucePrice[0]['price']) ? $saucePrice[0]['price'] : 0;

        return $saucePrice;
    }

    public function getTotalPrice()
    {

        $pizzaPrice =  $this->getPizzaPrice();

        $saucePrice = $this->getSaucePrice();

        $totalPrice = $pizzaPrice ? $pizzaPrice + $saucePrice : 0;

        return $totalPrice;
    }
}

$postPizza = $_GET['pizza_id'];
$postSize = $_GET['size_id'];
$postSauce = $_GET['sauce_id'];

$pizza = new Pizza($db, $postPizza, $postSize, $postSauce);



function check($pizza)
{
    $pizzaPrice = $pizza->pizzaPrice;
    $saucePrice = $pizza->saucePrice;
    $orderPrice = $pizza->totalPrice;
    $pizzaName = $pizza->pizzaName;
    $sizeName = $pizza->sizeName;
    $sauce = $pizza->sauce;
    if ($pizzaPrice <= 0 & $saucePrice  <= 0) {
        echo " <!DOCTYPE html>
    <html>
    
    <head>
        <title>чек</title>
        <meta charset='utf-8' />
        <link rel='stylesheet' href='style.css'>
    </head>
    
    <body>
        <form class='text'>
        <h3 > Вы ничего не выбрали!</h3>
        </form>
        
    </body>
    
    </html>";
    } elseif ($pizzaPrice && $saucePrice) {
        echo
        "<!DOCTYPE html>
        <html>
        
        <head>
            <title>чек</title>
            <meta charset='utf-8' />
            <link rel='stylesheet' href='style.css'>
        </head>
        
        <body>
            <form class='text'>
            <h3 > $pizzaName $sizeName см     -  $pizzaPrice бел.руб</h3>
            <h3 > $sauce соус                 -  $saucePrice бел.руб</h3>
            <h3 > Итого: $orderPrice бел.руб</h3>
            </form>
            <input class='select' type='submit' value='Оплатить'>
        </body>
        
        </html>";
    } elseif ($pizzaPrice <= 0) {
        echo
        "<!DOCTYPE html>
    <html>
    
    <head>
        <title>чек</title>
        <meta charset='utf-8' />
        <link rel='stylesheet' href='style.css'>
    </head>
    
    <body>
        <form class='text'>
        <h3 > $sauce соус                 -  $saucePrice бел.руб</h3>
        <h3 > Итого: $saucePrice бел.руб</h3>
        </form>
        <input class='select' type='submit' value='Оплатить'>
    </body>
    
    </html>";
    }

    elseif ($saucePrice <= 0) {
        echo
        "<!DOCTYPE html>
    <html>
    
    <head>
        <title>чек</title>
        <meta charset='utf-8' />
        <link rel='stylesheet' href='style.css'>
    </head>
    
    <body>
        <form class='text'>
        <h3 > $pizzaName $sizeName см     -  $pizzaPrice бел.руб</h3>
            <h3 > Итого: $pizzaPrice бел.руб</h3>
        </form>
        <input class='select' type='submit' value='Оплатить'>
    </body>
    
    </html>";
    }
}
check($pizza);
