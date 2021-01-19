<?php

//ХЕШИРОВАНИЕ ПАРОЛЯ В БД
 //echo password_hash('45zz/', PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.js" crossorigin="anonymous"></script>
  <title>Главная</title>
<style>
  .carousel-caption {
    position: absolute;
    bottom: 7%;
  }
  body {
    display: flex;
             min-height: 100vh;
            flex-direction: column;
            justify-content: space-between;          
  }
</style>
</head>
<body>
<!-- ШАПКА -->
  <ul class="nav navbar-light justify-content-around align-items-center bg-dark">
    <li class="nav-item">
      <a class="navbar-brand" href="/">
        <img src="/public/images/layout/logo.png" alt="" height="65px" width="170px"alt="">
      </a>
    </li>
    <li class="nav-item catalogue position-relative" style="height: 100%;">
      <a class="nav-link text-light" href="/">Главная</a>
      
    </li>

    <li class="nav-item">
      <a class="nav-link text-light" href="/catalogue">Каталог</a>
    </li>

    <li class="nav-item">
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->



<!-- //если пользователь не выполнил вход -->
<?php if (isset($_SESSION['auth']) and !empty($_SESSION['auth'])) : ?> 
  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Личный кабинет
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Заказы</a>
    <a class="dropdown-item" href="/cart">Корзина</a>
    <a class="dropdown-item" href="?do=exit">Выход</a>
  </div>
</div>
<?php else : ?>
      <a class="nav-link text-light" href="/entrance">
        <svg style="width: 30px; " height: 1.5em; viewBox="0 0 16 16" class="bi bi-person text-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
        </svg>
      </a>
<?php endif; ?>
    </li>
  </ul>

<!-- cодержимое страницы отображается в боди -->
  <?php echo $content; ?>

<!-- ФУТЕР -->
<footer class="footer row bg-dark">
<div class="col-lg-1 col-12 text-nowrap bd-highlight" style="width: 8rem;"  >
  <p class="font-weight-bold text-light" style="">Наши контакты: г.Москва ул.Арбатская д.18 стр.4</p>
</div>
<div class="col-7 offset-2 d-lg-flex justify-content-around">
</div>
</footer> 

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script> -->
</body>

</html>

