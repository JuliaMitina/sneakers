<?php
//var_dump($data);
if (!isset($_SESSION['auth']['id'])) {
    header('Location: http://sneakers.ru/');
    //  echo '<img src="/public/images/errors/404error.webp">';
} else
?>
<div class="container">
<h1 style="text-align: center; margin: 20px 0">КОРЗИНА</h1>
<?php if ($data == []) : ?>
    <h4>Ваша корзина пустая...</h4>
<?php else : ?>
    <?php //debug($data); 
    ?>
    <!-- <h1>Rjkbxtnc</h1> -->
    <div class="order">
        <?php foreach ($data as $product_cart) : ?>
            <div class="card mb-3" style="max-width: 900px;">
                <div class="row no-gutters products-cart">
                    <!-- <button type="button" class="btn btn-outline-danger position-absolute" style="right: 10px; top: 10px">Удалить из корзины</button> -->

                    <div class="col-md-4">
                        <img src="<?= $product_cart['image']; ?>" class="card-img" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title"><?= $product_cart['name']; ?></h5>
                                <button type="button" class="btn btn-outline-secondary delete-product">&#10008;</button>
                                <!-- <a class="btn btn-primary" href="#" role="button"> &#10008;</a> -->
                                <!-- <a href=""> &#10008;</a> -->
                            </div>
                            <p class="card-text"></p>
                            <label for="">Количество:</label>
                            <input type="number" class="card-text countInput" min="1" value=<?= $product_cart['count']; ?>>
                            <p class="card-text"><small class="text-muted"><?= $product_cart['description']; ?></small></p>
                            <span>Стоимость:</span>
                            <p class="card-text price-card"><?= $product_cart['price'] * $product_cart['count'] ?></p>

                            <p class="card-text id-product" hidden><?= $product_cart['product_id']; ?> </p>
                            <!-- <button class="btn card-text delete-product">Удалить из корзины</button> -->
                            <!-- <button type="button" class="btn btn-outline-danger">Удалить из корзины</button> -->


                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        <div class="card mb-3 " style="max-width: 900px;">
            <div class="end d-flex justify-content-end justify-content-between">
                <h5>Всего товаров: <?php echo count($data); ?> </h5>
                <!-- <h5>Сумма заказа: // $totalPrice; </h5> -->
                <button type="button" data-toggle="modal" class="btn btn-primary checkout" data-target="#staticBackdrop">Оформить заказ</button>

            </div>
        </div>
    <?php endif; ?>

    </div>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Launch static backdrop modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Оформление заказа</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="success-checkout"></p>
                    <h7>Всего товаров: <?php echo count($data); ?> </h7>
                    <div class="d-flex">
                        <h7>Сумма заказа: </h7>
                        <span id="total-sum"></span>
                    </div>
                    <!-- <h5> Личные данные: </h5> -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary do-order">Оформить</button>
                </div>
            </div>
        </div>
    </div>





    <!-- //при изенении кол-ва в корзине меняется и цена -->
    <script>
        // let count_product = $('input.card-text').val(); //то  что в инпут * на то что в data
        // let id_product = $('p.id-product').text(); //id в input
        $('.countInput').on('change', function() {
            let countInput = $(this).val();
            let idProduct = $(this).siblings('.id-product').text();
            let id = $(this).siblings('.id-product');
            // console.log(idProduct);
            // console.log(countInput);

            $.ajax({
                method: "POST",

                //файл на кот передается инфа
                url: "/cart/setPrice",

                //инфа, кот передается на php
                data: {
                    count_change: countInput,
                    product_id: idProduct,

                }
                // dataType: "json"
                //показать сообщение на экране перед отправкой информации
                // beforeSend: function(){
                //     alert('start sending');
                // }

            }).done(function(resp) {
                if (resp == false) {
                    alert('Ошибка.Повторите позже!');
                } else {
                    const newPrice = JSON.parse(resp);
                    console.log(newPrice);
                    $(id).prev().text(newPrice);

                    // console.log(products);
                }


            })
        })
    </script>

    <!-- удаление товара из корзины -->
    <script>
        $('.products-cart').on('click', '.delete-product', function() {
            // console.log($(this));
            res = confirm('Удалить товар из корзины?');
            if (res) {

                let productId = $(this).closest('.card-body').find('.id-product').text();
                // console.log(priductId);
                // console.log(countInput);

                $.ajax({
                    method: "POST",

                    //файл на кот передается инфа
                    url: "/cart/deleteFromCart",

                    //инфа, кот передается на php
                    data: {
                        // count_change: countInput,
                        product_id: productId,
                    }
                    // dataType: "json"
                    //показать сообщение на экране перед отправкой информации
                    // beforeSend: function(){
                    //     alert('start sending');
                    // }

                }).done(function(resp) {
                    if (resp == false) {
                        alert('Ошибка.Повторите позже!');
                    } else {
                        const answer = JSON.parse(resp);
                        console.log(answer);

                        // console.log($(this).parents('.card'));
                        if (answer == []) {
                            $('.order').html('Ваша корзина пустая');
                            // h4 > Ваша корзина пустая... < /h4>
                        } else {
                            location.reload();
                        }

                        // $(this).parents('.card').remove();
                        // $(this).parents('.card').empty();
                        //                 var productCard = '';
                        //                 answer.forEach(product => {
                        //                     let price = product.price * product.count;
                        //                     productCard +=
                        //                         `
                        //                 <div class="card mb-3" style="max-width: 900px;">
                        //                  <div class="row no-gutters products-cart">
                        //                  <!-- <button type="button" class="btn btn-outline-danger position-absolute" style="right: 10px; top: 10px">Удалить из корзины</button> -->

                        //             <div class="col-md-4">
                        //                 <img src="${product.image}" class="card-img" alt="">
                        //             </div>
                        //             <div class="col-md-8">
                        //                 <div class="card-body">
                        //                     <div class="d-flex justify-content-between">
                        //                         <h5 class="card-title">${product.name}</h5>
                        //                         <button type="button" class="btn btn-outline-danger delete-product">&#10008;</button>
                        //                         <!-- <a class="btn btn-primary" href="#" role="button"> &#10008;</a> -->
                        //                         <!-- <a href=""> &#10008;</a> -->
                        //                     </div>
                        //                     <p class="card-text"></p>
                        //                     <label for="">Количество:</label>
                        //                     <input type="number" class="card-text countInput" min="1" value=${product.count}>
                        //                     <p class="card-text"><small class="text-muted">${product.description}</small></p>
                        //                     <span>Стоимость:</span>
                        //                     <p class="card-text price-card"> ${price} </p>

                        //                     <p class="card-text id-product" hidden> ${product.product_id} </p>
                        //                     <!-- <button class="btn card-text delete-product">Удалить из корзины</button> -->
                        //                     <!-- <button type="button" class="btn btn-outline-danger">Удалить из корзины</button> -->


                        //                 </div>
                        //             </div>
                        //         </div>
                        //     </div>
                        //                     `;
                        //                 });
                        //                 productCard += `<div class="card mb-3 " style="max-width: 900px;">
                        //     <div class="end d-flex justify-content-end justify-content-between">
                        //         <p>Всего товаров:</p>
                        //         <button type="button" class="btn btn-warning">Оформить заказ</button>

                        //     </div>
                        // </div>`
                        //                 $('.order').html(productCard);
                        // console.log(products);
                    }


                })

            }
        })
    </script>

    <!-- оформление товара -->
    <script>
        //расфокусировка с количесва - запись кол-ва новго в бд
        $('.countInput').on('blur', function() {
            let idProduct = $(this).siblings('.id-product').text();
            let countInput = $(this).val();
            console.log(countInput);
            //если кол-во измненилось- то запись его в бд - корзину
            $.ajax({
                method: "POST",

                //файл на кот передается инфа
                url: "/cart/setCountProduct",

                //инфа, кот передается на php
                data: {
                    count_change: countInput,
                    product_id: idProduct,
                }


            }).done(function(resp) {
                if (resp == false) {
                    alert('Ошибка.Повторите позже!');
                } else {
                    const answer = JSON.parse(resp);
                    console.log(answer);
                }
            })

            // console.log(idProduct);
        })
        $('.checkout').on('click', function() {
            let sum = 0;
            $('#total-sum').text('');
            $('.price-card').each(function() {
                sum += parseInt($(this).text());
            })
            console.log(sum);
            $('#total-sum').append(sum + ' Р');

            // const productId = $(this).data('index');
            // console.log(productId);



        })

        //удаление корзины и запись данных в бд
        $('.do-order').on('click', function() {

            // взять стоимость с бд
            $.ajax({
                method: "POST",

                //файл на кот передается инфа
                url: "/cart/checkout",

                //инфа, кот передается на php
                data: {

                }


            }).done(function(resp) {
                if (resp == false) {
                    alert('Ошибка.Повторите позже!');
                } else {
                    const answer = JSON.parse(resp);
                    console.log(answer);
                    $('.success-checkout').text('Заказ успешно формлен!');
                }
            })

            $('.close').on('click', function () {
                location.reload();
            })

        })
    </script>