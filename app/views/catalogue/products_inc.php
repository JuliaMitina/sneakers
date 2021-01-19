<?php //debug($product) ?>
<style>
 input[type="number"] {
   display: inline-block;
   width: 70px;
   font-weight: bold;
 }
 </style>

<script src="/public/script/modal_ajax.js"></script>

<!-- КАРТОЧКА ВЫВОД ПРОДУКТА КАТАЛОГ -->
 <div class="row row-cols-1 row-cols-md-3 cards"> 
  <?php foreach ($data as $product) : ?>
  <div class="col mb-4">
    <div class="card h-100">

      <img class="card-img-top product-image" src="<?= $product['image']; ?>" style="width: 220px; alt="...">

      <div class="card-body">
        <h5 class="card-title product-name"><?= $product['name']; ?></h5>

        <span class="product-description"><?= $product['description']; ?></span>

        <h3 class="card-text product-price"><?= $product['price'] . ' ₽'?></h3>

        <button type="button" class="btn btn-primary buy" data-toggle="modal" data-target="#exampleModal" data-id="<?= $product['id']; ?>">
        ДОБАВИТЬ  &#128722;
        </button> 
        
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div> 


<!-- (МОДАЛЬНОЕ ОКНО )
BUTTON TRIGGER MODAL-->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Запустить модальное окно
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modal-products-name" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-products-name">КОРЗИНА</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 <!-- карточка для корзины -->


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Оформить заказ</button>
      </div>
    </div>
  </div>
</div>

<script>
$('.cards').on('click', '.buy' ,function() {
let productImage = $(this).closest('.card').find('.product-image').attr('src');
let productName = $(this).closest('.card').find('.product-name').text();
let productDescription = $(this).closest('.card').find('.product-description').text();
let productPrice = $(this).closest('.card').find('.product-price').text();
let productId = $(this).data('id');

// $('.modal-product-image').attr('src', productImage);
// $('.modal-product-name').text(productName);
// $('.modal-product-description').text(productDescription);
// $('.modal-product-price').text(productPrice);

//Если проверка на пользователя прошла успешна(он есть), используем ajax/ иначе ошибка
if(<?= (isset($_SESSION['auth']['id']) and !empty($_SESSION['auth']['id'])) ? $_SESSION['auth']['id'] : 'false'; ?>) {

$.ajax({
  method: 'POST',
  url: "/catalogue/add_to_cart",
  data: {
  product_id: productId,
  count: 1,
  price: productPrice.replace(' ₽', '')
  }

}).done(function(resp) { //результат успешного выполнения работы вернется обратно

  const products = JSON.parse(resp);
  // const products = resp;
 console.log(products); 
 
if (resp == 'false') {
  alert('Ошибка при добавлении товара.')
} else {// все продукты из бд
  // const products = jQuery.parseJSON(resp);
// console.log(products); 
  const products = JSON.parse(resp);
  var productCard = '';
    products.forEach(product => {
    productCard += `<div class="row no-gutters">
    <div class="col-md-4">
    <img src=" ${product.image}" class="card-img-top modal-product-image" style="width: 150px; alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h6 class="card-title">Наименование: <span class="modal-product-name" style="font-weight:normal">
        ${product.name}
        </span> </h6>

       

        <h6 class="card-title">Кол-во: <span class=""><input type="number" name="amount" id="" value=""></span>
        </h6>
 
        <h6 class="card-title">Цена: <span  class="modal-product-price" style="font-weight:normal">
        ${product.price}
        </span> </h6>

      </div>
    </div>
  </div>`
  
  });

  
  $('#modal-products-name').html(productCard);

}
  
}); //окончание ajax

} else {
  alert('Выполните вход в личный кабинет')
  location.replace('http://sneakers.ru/entrance'); //если не авторизован пользователь
}


})

</script>
  










