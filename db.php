<?php
include_once "dbConnect.php";
$db = new Database();
$totalPrice = 0;

if (isset($_POST['pizza_id'])) {
    if ($_POST['pizza_id'] == 999) {
        echo "<option value='999'>Выберите размер</option>";
    } else {
        $query = "SELECT * FROM sizes where id_pizza=" . $_POST['pizza_id'];

        $result = $db->query($query);

        echo "<option value='999'>Выберите размер</option>";
        foreach ($result as $elem) {
            echo '<option value=' . $elem['id_size'] . '>' . $elem['size'] . '</option>';
        }
    }
}
if (isset($_POST['size_id'])) {
    if ($_POST['size_id'] == 999) {
        null;
    } else {
        $query = "SELECT price FROM sizes
    LEFT JOIN pizzas ON pizzas.id=sizes.id_pizza 
    WHERE pizzas.id='{$_POST['pizza2']}'  and sizes.id_size='{$_POST['size_id']}'";

        $result = $db->query($query);
        $sumPizza = $result[0]['price'];
        $totalPrice += $sumPizza;
        echo "<h3>Стоимость пиццы: $sumPizza бел.руб</h3>";
    }
}
if (isset($_POST['sauce_id'])) {
    if ($_POST['sauce_id'] == "Без" || $_POST['sauce_id'] == 999) {
        null;
    } else {
        $query = "SELECT price FROM sauces WHERE sauce='{$_POST['sauce_id']}'";
        $result = $db->query($query);
        $sumSauce = $result[0]['price'];
        $totalPrice += $sumSauce;
        echo "<h3>Стоимость соуса:  $sumSauce бел.руб</h3>";
    }
}




$pricePizza = $priceSauce = 0;
if (isset($_POST['flag2']) ) {
    $query = "SELECT price FROM sizes
    LEFT JOIN pizzas ON pizzas.id=sizes.id_pizza 
    WHERE pizzas.id='{$_POST['flag1']}'  and sizes.id_size='{$_POST['flag2']}'";

    $result = $db->query($query);
    if(count($result)){
        $pricePizza = $result[0]['price'];
    }
}
if( isset($_POST['flag3'])) {

    $query = "SELECT price FROM sauces WHERE sauce='{$_POST['flag3']}'";
    $result = $db->query($query);
    if(count($result))
    $priceSauce = $result[0]['price'];
}
if(isset($_POST['flag2']) || isset($_POST['flag3'])) {
    $totalPrice = $pricePizza + $priceSauce;
    echo "<h3>Стоимость заказа: $totalPrice бел.руб</h3>";
}

// return json_encode([
//     'pizza_price' => '',
//     'sause_price' => null,
//     'total_price' => '<h3>Стоимость заказа: $totalPrice бел.руб</h3>',
// ]);

/*elseif (isset($_POST['flag2'])) {
    $query = "SELECT price FROM sizes
    LEFT JOIN pizzas ON pizzas.id=sizes.id_pizza 
    WHERE pizzas.id='{$_POST['flag1']}'  and sizes.id_size='{$_POST['flag2']}'";

    $result = $db->query($query);
    $totalPrice = $result[0]['price'];

    echo "<h3>Стоимость заказа: $totalPrice бел.руб</h3>";
}*/