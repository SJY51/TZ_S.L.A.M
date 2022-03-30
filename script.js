let Obj = {};

function SendPizza(id) {    
    let intPizza = id;
    Obj.one = intPizza;

    $('#size').html();

    $.ajax({
        type: 'post',
        url: 'db.php',
        data: {
            pizza_id: id
        },
        success: function (data) {
            $('#size').html(data);
            if(data == "<option value='999'>Выберите размер</option>") {
                $('#costPizza').html('');
                $('#orderCost').html('Сумма заказа: 0 бел.руб');
            }
        }
    })
}

function SendSize(id) {
    let intSize = id;
    Obj.two = intSize;
    let intPizza = Obj.one;
    $('#costPizza').html();
    $.ajax({
        type: 'post',
        url: 'db.php',
        data: {
            size_id: id,
            pizza2: intPizza
        },
        success: function (data) {
            $('#costPizza').html(data);
        }
    })
}

function SendSauce(id) {
    let intSauce = id;
    Obj.three = intSauce;
    $('#costSauce').html();
    $.ajax({
        type: 'post',
        url: 'db.php',
        data: {
            sauce_id: id,
        },
        success: function (data) {
            $('#costSauce').html(data);
        }
    })
}
function orderCost() {
    $('#orderCost').html();
    let one = Obj.one
    let two = Obj.two
    let three = Obj.three
    $.ajax({
        type: 'post',
        url: 'db.php',
        data: {
            flag1: one,
            flag2: two,
            flag3: three,
        },
        success: function (data) {
            $('#orderCost').html(data);
        }
    })
}
