<!DOCTYPE html>
<html>

<head>
    <title>Терминал</title>
    <meta charset="utf-8" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php
    require_once 'db.php';
    $sauceMass = $db->query("SELECT sauce FROM sauces  ");
    $query = "SELECT * FROM pizzas ";
    $result = $db->query($query);

    ?>
    <form action="cost.php" method="GET" id="mainForm">

        <select name="pizza_id" id="pizza" class="select" onchange="SendPizza(this.value)" required>
            <option value="999">Выберите пиццу</option>
            <?php

            foreach ($result as $elem) {
                echo '<option value=' . $elem['id'] . '>' . $elem['pizza'] . '</option>';
            }

            ?>
        </select>
        <h3></h3>
        <select name="size_id" id="size" class="select" onchange="SendSize(this.value);orderCost()">
            <option value="999">Выберите размер</option>
        </select>

        <h3 class="price" name="costPizza" id="costPizza"></h3>

        <select class="select " name="sauce_id" id="sauce" onchange="SendSauce(this.value);orderCost()">
            <option value="999">Выберите соус</option>
            <?php foreach ($sauceMass as $elem) {
                $str = implode($elem);
                $result = "<option value =$str>" . $str  . '</option>';
                echo $result;
            } ?>
        </select>

        <h3 class="price" name="costSauce" id="costSauce"></h3>

        <input class="select" type="submit" value="Заказать">
        <h3 class="price" name="orderCost" id="orderCost">Сумма заказа: 0 бел.руб </h3>
    </form>
</body>

</html>