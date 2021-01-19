<!-- <?php debug($data); ?> -->
<h1 style="text-align: center;">КАТАЛОГ</h1>

<!-- КАРТОЧКИ КАТЕГОРИЙ(adidas/nike) -->
  <div class="container mb-3" style="max-width: 740px;">
<?php foreach ($data as $cat) : ?>
  <div class="card mb-3" style="max-width: 740px;">
  <div class="row no-gutters " style="margin-bottom: 20px">
    <div class="col-md-4">
      <img src="<?= $cat['image']; ?>" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
    <h5 class="card-text"><?= $cat['description']; ?></h5>
        
    <a href="" class="btn btn-secondary d-flex justify-content-center show-products" data-id="<?= $cat['id']; ?>" data-path="<?= $cat['path']; ?>">Открыть</a>
      </div>
    </div>
  </div>
  </div>
<?php endforeach; ?>

</div>

 <script>
 //ПЕРЕХОД ПО КАТЕГОРИЯМ и отображ. товаров по категориям
    $('.card').on('click', '.show-products', function(e) 
    {  //по нажатию на ссылку чтобы не было обновл.стр
        e.preventDefault();
        const catId = ($(this).data('id'));
        const path = $(this).data('path');
        console.log(catId);
        location.replace(`catalogue/${path}?cat_id=${catId}`);
        
    })

</script> 
