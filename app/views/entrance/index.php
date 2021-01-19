  <!-- ФОРМА ВХОДА/РЕГИСТРАЦИИ -->

<div class="d-flex justify-content-center">
<form class="needs-validation auth" method="POST">
<h1>ВХОД</h1>
  <div class="form-row">
    <div class="col-md-6 mb-3">
    <label for="exampleInputEmail1">Email адрес</label>
    <input type="email" class="form-control mail" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="^([A-Za-z0-9_-]+\.)*[A-Za-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$" name="text" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="text" class="form-control pass" id="exampleInputPassword1" pattern="^(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{4,15}" name="password" required>    
    </div>
    </div>
    <button class="btn btn-primary " type="submit">Войти</button>
</form>


<form class="needs-validation reg" method="POST">
<h1>РЕГИСТРАЦИЯ</h1>
  <p class="alert"></p>
<div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationServer01">Имя</label>
      <input type="text" class="form-control is-valid name" id="validationServer01"  name="text" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationServer02">Фамилия</label>
      <input type="text" class="form-control is-valid lastname" id="validationServer02"  name="text" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
    <label for="exampleInputEmail1">Email адрес</label>
    <input type="email" class="form-control regmail" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="^([A-Za-z0-9_-]+\.)*[A-Za-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$" name="text">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="text" class="form-control regpass" id="exampleInputPassword1" pattern="^(?=.*[a-z])(?=.*[0-9])(?=.*[^\w\s]).{4,15}" name="password">    
    </div>
    </div>
    <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
</form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        //console.log($(this));
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        } else {
        event.preventDefault();
        const name = $('.name').val();
        const lastname = $('.lastname').val(); //значение из инпутов
        const regmail = $('.regmail').val(); //значение из инпутов
        const regpass = $('.regpass').val(); //значение из инпутов
        const mail = $('.mail').val(); //значение из инпутов СЕЛЕКТОР lэто то, к чему обращаемся
        const pass = $('.pass').val(); //значение из инпутов
        if($(this).hasClass("auth")) {
      
          
           //  //для входа
          $.ajax({
        method: "POST",
        url: "/entrance/checkuser",              //то самое место, где обрабатывается в php из js
        data:{                                    //передача данных из js в php (то что предаю)
       mail: mail,
       password: pass
        } 
      }).done(function(resp) {  // функция кот. принимает на себя ответ из php(переменная любая)
      
      console.log(resp);
    if(resp == 'false') {
        alert('НЕкорректные данные!');
    } else { 
      const user = JSON.parse(resp);
      console.log(user);
      // header('location: ' . $_SERVER['REDIRECT_URL']);
      location.replace('http://sneakers.ru/');
        //alert('Заказ успешно оформлен!');
    }
})
        } else if ($(this).hasClass("reg"))  {
          // console.log(name);
          // console.log(lastname);
          // console.log(regmail);
          // console.log(regpass);
         //ДЛЯ РЕГИСТРАЦИИ
          $.ajax({
    method: "POST",
    url: "/entrance/registration",              //то самое место, где обрабатывается в php из js
    data:{
      name: name,
      lastname: lastname,                       //передача данных из js в php (то что предаю)
      mail: regmail,
      password: regpass
        } 
}).done(function(resp) {
  // console.log(resp);
  const user = JSON.parse(resp);
 console.log(user);
    if(user == 'false') {
        //alert('Пользователь с таким EMAIL уже существует');
        $(".alert").text("Пользователь с таким EMAIL уже существует.");
    } else { 
      // header('location: ' . $_SERVER['REDIRECT_URL']);
      //location.reload();
        //alert('Заказ успешно оформлен!');
        $(".alert").text("Вы успешно прошли авторизацию");

    }
        })
         
        }
      }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>





