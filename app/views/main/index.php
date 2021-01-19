<!-- <?php debug($data); ?> -->

<!-- КАРУСЕЛЬ -->
<div id="carouselExampleCaptions" class="carousel slide card" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
</ol>

<div class="carousel-inner">
<div class="carousel-item active">
  <img src="public/images/karusel/adidas.jpg" class="d-block w-100" alt="..." style="height:550px">
  <div class="carousel-caption d-none d-md-block">
    <p style="font-size: 35px">Adidas</p>
    <!-- <a href="" class="btn btn-secondary d-flex justify-content-center show-products" data-id="<?= $cat['id']; ?>" data-path="<?= $cat['path']; ?>">Открыть</a> -->
  </div>
  
</div>
<div class="carousel-item">
  <img src="public/images/karusel/nike.jpg" class="d-block w-100" alt="..." style="height:550px">
  <div class="carousel-caption d-none d-md-block">
    <p style="font-size: 35px">Nike</p>
    <!-- <a href="" class="btn btn-secondary d-flex justify-content-center show-products" data-id="<?= $cat['id']; ?>" data-path="<?= $cat['path']; ?>">Открыть</a>	 -->
    </a>

  </div>
</div>
<div class="carousel-item">
  <img src="public/images/karusel/discount1.jpg" class="d-block w-100" style="height:550px">
  <div class="carousel-caption d-none d-md-block">
  <p href="" class="btn-secondary d-flex justify-content-center show-products" data-id="<?= $cat['id']; ?>" data-path="<?= $cat['path']; ?>">Скидки до 70%</p>
  </div>
</div>
</div>

<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>














